<script setup>
// InvoiceShelf brand lockup, rendered inline so it matches the website exactly.
// "Invoice" uses currentColor (inherits the navbar text color) so it flips with
// the light/dark theme automatically; the tile and "Shelf" stay brand indigo on
// both. Mirrors resources/js/Components/ApplicationLogo.vue on the website.
</script>

<template>
    <svg
        viewBox="0 0 232 48"
        height="30"
        fill="none"
        role="img"
        aria-label="InvoiceShelf"
        xmlns="http://www.w3.org/2000/svg"
        style="display: block"
    >
        <rect x="1" y="1" width="46" height="46" rx="9" fill="#4A3DFF" />
        <g transform="translate(22.5 24) scale(0.78) translate(-24 -24)">
            <path
                d="M12,11 a4,4 0 0 1 4,-4 h16 a4,4 0 0 1 4,4 v22 l-2,4 l-2,-4 l-2,4 l-2,-4 l-2,4 l-2,-4 l-2,4 l-2,-4 l-2,4 l-2,-4 l-2,4 l-2,-4 Z"
                fill="none"
                stroke="#fff"
                stroke-width="2.9"
                stroke-linejoin="round"
            />
            <line x1="17" y1="16" x2="31" y2="16" stroke="#fff" stroke-width="2.9" stroke-linecap="round" />
            <line x1="17" y1="21.5" x2="26" y2="21.5" stroke="#fff" stroke-width="2.9" stroke-linecap="round" />
            <circle cx="33" cy="33" r="9" fill="#fff" />
            <path
                d="M29.2 33.2 l2.6 2.7 l4.6 -5.6"
                fill="none"
                stroke="#4A3DFF"
                stroke-width="2.9"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
        </g>
        <text x="60" y="32" font-family="Poppins, sans-serif" font-weight="700" font-size="27" letter-spacing="-0.7">
            <tspan fill="currentColor">Invoice</tspan><tspan fill="#4A3DFF">Shelf</tspan>
        </text>
    </svg>
</template>
