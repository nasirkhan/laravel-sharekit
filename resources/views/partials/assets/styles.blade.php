<style>
    [data-sharekit] {
        --sk-font: ui-sans-serif, system-ui, sans-serif;
        --sk-radius: 999px;
        --sk-gap: 0.75rem;
        --sk-padding-y: 0.72rem;
        --sk-padding-x: 1rem;
        --sk-font-size: 0.95rem;
        --sk-font-weight: 600;
        --sk-bg: #ffffff;
        --sk-text: #111827;
        --sk-border: rgba(17, 24, 39, 0.12);
        --sk-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        --sk-hover-shadow: 0 16px 36px rgba(15, 23, 42, 0.14);
        --sk-heading: #0f172a;
        --sk-icon-size: 1.1rem;
    }

    [data-sharekit][data-sharekit-theme="tailwind"] {
        --sk-bg: #f8fafc;
        --sk-text: #0f172a;
        --sk-border: rgba(148, 163, 184, 0.45);
        --sk-shadow: 0 1px 2px rgba(15, 23, 42, 0.08);
        --sk-hover-shadow: 0 10px 25px rgba(15, 23, 42, 0.12);
        --sk-heading: #020617;
    }

    [data-sharekit] .sk-root,
    [data-sharekit].sk-root,
    [data-sharekit] {
        font-family: var(--sk-font);
    }

    [data-sharekit] .sk-heading,
    [data-sharekit] .sk-list,
    [data-sharekit] .sk-item,
    [data-sharekit] .sk-button,
    [data-sharekit] .sk-button-icon,
    [data-sharekit] .sk-button-label {
        box-sizing: border-box;
    }

    [data-sharekit] .sk-heading {
        margin-bottom: 0.85rem;
        color: var(--sk-heading);
        font-size: 0.95rem;
        font-weight: 700;
        letter-spacing: 0.01em;
    }

    [data-sharekit] .sk-list {
        display: flex;
        flex-wrap: wrap;
        gap: var(--sk-gap);
    }

    [data-sharekit] .sk-item {
        display: inline-flex;
    }

    [data-sharekit] .sk-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.65rem;
        min-height: 2.85rem;
        padding: var(--sk-padding-y) var(--sk-padding-x);
        border-radius: var(--sk-radius);
        border: 1px solid var(--sk-border);
        background: var(--sk-bg);
        color: var(--sk-text);
        text-decoration: none;
        box-shadow: var(--sk-shadow);
        cursor: pointer;
        transition: transform 160ms ease, box-shadow 160ms ease, border-color 160ms ease, background-color 160ms ease;
    }

    [data-sharekit] .sk-button:hover {
        transform: translateY(-1px);
        box-shadow: var(--sk-hover-shadow);
    }

    [data-sharekit] .sk-button:focus-visible {
        outline: 3px solid rgba(59, 130, 246, 0.25);
        outline-offset: 2px;
    }

    [data-sharekit] .sk-button-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 1.5rem;
        height: 1.5rem;
        color: currentColor;
        flex-shrink: 0;
    }

    [data-sharekit] .sk-icon-svg {
        width: var(--sk-icon-size);
        height: var(--sk-icon-size);
        display: block;
    }

    [data-sharekit] .sk-button-label {
        font-size: var(--sk-font-size);
        font-weight: var(--sk-font-weight);
        line-height: 1;
        white-space: nowrap;
    }

    [data-sharekit] [data-sharekit-size="sm"] {
        --sk-padding-y: 0.6rem;
        --sk-padding-x: 0.85rem;
        --sk-font-size: 0.875rem;
        --sk-icon-size: 1rem;
    }

    [data-sharekit] [data-sharekit-size="lg"] {
        --sk-padding-y: 0.85rem;
        --sk-padding-x: 1.1rem;
        --sk-font-size: 1rem;
        --sk-icon-size: 1.2rem;
    }

    [data-sharekit] [data-sharekit-network="x"] { color: #111827; }
    [data-sharekit] [data-sharekit-network="facebook"] { color: #1877f2; }
    [data-sharekit] [data-sharekit-network="linkedin"] { color: #0a66c2; }
    [data-sharekit] [data-sharekit-network="whatsapp"] { color: #25d366; }
    [data-sharekit] [data-sharekit-network="telegram"] { color: #229ed9; }
    [data-sharekit] [data-sharekit-network="reddit"] { color: #ff4500; }
    [data-sharekit] [data-sharekit-network="email"] { color: #8b5cf6; }
    [data-sharekit] [data-sharekit-network="copy"] { color: #475569; }
    [data-sharekit] [data-sharekit-network="native"] { color: #0f172a; }

    [data-sharekit] [data-sharekit-network="native"][hidden] {
        display: none !important;
    }

    @media (max-width: 640px) {
        [data-sharekit] .sk-list {
            gap: 0.6rem;
        }

        [data-sharekit] .sk-button {
            width: 100%;
            justify-content: flex-start;
        }

        [data-sharekit] .sk-item {
            flex: 1 1 calc(50% - 0.6rem);
        }
    }
</style>
