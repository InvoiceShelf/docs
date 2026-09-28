#!/usr/bin/env python3
"""Publish a validated master commit. No content or credentials are printed."""
import json
import os
import re
import time
import urllib.request

BASE = 'https://invoiceshelf.com'
token = os.environ.get('CI_DOCS_TOKEN', '')
commit = os.environ.get('DOCS_COMMIT', '')
if not token or not re.fullmatch('[a-f0-9]{40}', commit):
    raise SystemExit('Configure CI_DOCS_TOKEN and a full DOCS_COMMIT before publishing.')

def request(path, data=None):
    req = urllib.request.Request(BASE + path,
        data=json.dumps(data).encode() if data is not None else None,
        headers={'Authorization': 'Bearer ' + token, 'Accept': 'application/json', 'Content-Type': 'application/json'})
    with urllib.request.urlopen(req, timeout=30) as response:
        return json.load(response)

job = request('/api/docs/imports', {'commit': commit})
if not isinstance(job.get('id'), int):
    raise SystemExit('Unexpected import receipt.')
for _ in range(120):
    state = request('/api/docs/imports/' + str(job['id']))
    if state['status'] in ('published', 'superseded'):
        print('Documentation ' + state['status'] + ': ' + commit)
        break
    if state['status'] == 'failed':
        raise SystemExit('Documentation import failed: ' + str(state.get('error', 'Check docs:status.')))
    time.sleep(5)
else:
    raise SystemExit('Publication timed out. Inspect the docs worker and docs:status; the previous revision remains available.')
