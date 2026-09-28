---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: a4eb7814a2da8658ac9de56406720cbe6c52b127e9c22c3861c3a7a8091a184c
---

# Tasks and projects

**Tasks and Projects** is an optional official module for InvoiceShelf 3. This guide
covers module **0.2.1** with the v3 host described by this book. Install a compatible
module package before looking for these screens; they are not enabled by default.

## Install and configure

A super administrator installs and enables **Tasks and Projects** through
**Administration → Modules**. See [Modules](./modules.md) for marketplace pairing
and package compatibility.

Open **Company Settings → Tasks and Projects** to set the default hourly rate,
time-rounding rules, first day of the week, and whether members may see each
other's time. Settings also control starting a timer when a task is created,
locking invoiced tasks, hiding invoiced tasks from the board, and which task/time
information appears on invoice lines.

The module adds **Projects** and **Tasks** to the menu. If either is missing, check
that the module is enabled and that your company role permits viewing it.

## Organize work in projects

Create a project with a name, optional customer, status, and description. Set a
billable rate, budget, and due date when needed. A project without a customer is
internal work and is not available for customer invoicing.

Use a project's tabs to review its overview, tasks, time, and members. Members can
have project-specific hourly rates. Check the customer and currency before
starting work that will be billed.

## Choose a task view

Open **Tasks** and use the view selector:

- **List** shows sortable task rows.
- **Board** groups tasks by the company's task statuses and supports drag ordering.
- **Week** shows the timesheet for the selected week.

Project, member, and status filters stay in the URL when switching views. Open a
task to see its details and time log.

## Track time

Start or stop a timer from a task row, board card, task page, or the floating timer
control. The header shows the elapsed time and links to the running task. Only one
timer can run per user in each company; starting another offers to stop the first.

You can also enter time manually. Review its start, end, duration, description,
billable flag, and member. Rounding follows the company's module settings.

Rates are resolved from the task, then the member's project rate, the project
rate, and finally the company default. The rate is saved with the time entry so a
later rate change does not rewrite past work.

## Turn work into an invoice

Select **Invoice** from a task, a selection of tasks, or a project to prepare a
**draft invoice**. The draft opens in InvoiceShelf's invoice editor with one line
per task. Review the dates, descriptions, tax, and totals before sending it.

A selection spanning different customers or currencies is refused. Use separate
invoices for those groups.

The **Unbilled time** page, linked from Reports and the Projects header, brings
uninvoiced time together across projects. Use it to review what is ready to bill
and leave individual entries out when necessary.

Once an entry is on an invoice, its time, billable flag, and task cannot be changed.
Its description remains editable. Your role needs the module's invoicing permission
and InvoiceShelf's create/edit-invoice permissions to use this workflow.

## Disable or remove the module

Disabling the module hides its screens and routes while retaining data.
Uninstalling removes the package. Selecting **Remove module data** also removes
the module's settings and stored project/task/time records; this is permanent.

Back up the installation before removal and review invoices already created from
tracked work. See [Backups](./backups.md).
