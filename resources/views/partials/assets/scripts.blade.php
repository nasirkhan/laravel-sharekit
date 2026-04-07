<script>
    (() => {
        if (window.Sharekit) {
            window.Sharekit.init();
            return;
        }

        const selectors = {
            root: '[data-sharekit]',
            button: '[data-sharekit-button]'
        };

        const readMeta = (queries) => {
            for (const query of queries) {
                const node = document.querySelector(query);
                if (!node) {
                    continue;
                }

                if (node.getAttribute('content')) {
                    return node.getAttribute('content');
                }

                if (node.getAttribute('href')) {
                    return node.getAttribute('href');
                }
            }

            return '';
        };

        const pageMetadata = () => ({
            url: readMeta(['meta[property="og:url"]', 'link[rel="canonical"]']) || window.location.href,
            title: readMeta(['meta[property="og:title"]', 'meta[name="twitter:title"]']) || document.title,
            text: readMeta(['meta[property="og:title"]', 'meta[name="twitter:title"]']) || document.title,
            description: readMeta(['meta[property="og:description"]', 'meta[name="description"]', 'meta[name="twitter:description"]']),
            image: readMeta(['meta[property="og:image"]', 'meta[name="twitter:image"]'])
        });

        const encode = (value) => encodeURIComponent(value || '');

        const buildUrl = (network, metadata) => {
            const url = encode(metadata.url);
            const title = encode(metadata.title);
            const text = encode(metadata.text || metadata.title);
            const via = encode(metadata.via);
            const hashtags = encode(metadata.hashtags);

            switch (network) {
                case 'facebook':
                    return `https://www.facebook.com/sharer/sharer.php?u=${url}`;
                case 'x':
                    return `https://twitter.com/intent/tweet?url=${url}&text=${text}${metadata.via ? `&via=${via}` : ''}${metadata.hashtags ? `&hashtags=${hashtags}` : ''}`;
                case 'linkedin':
                    return `https://www.linkedin.com/sharing/share-offsite/?url=${url}`;
                case 'whatsapp':
                    return `https://wa.me/?text=${encode(`${metadata.text || metadata.title} ${metadata.url}`.trim())}`;
                case 'telegram':
                    return `https://t.me/share/url?url=${url}&text=${text}`;
                case 'reddit':
                    return `https://www.reddit.com/submit?url=${url}&title=${title}`;
                case 'email':
                    return `mailto:?subject=${title}&body=${encode(`${metadata.text || metadata.title}\n\n${metadata.url}${metadata.description ? `\n\n${metadata.description}` : ''}`)}`;
                default:
                    return metadata.url;
            }
        };

        const popup = (shareUrl, width, height) => {
            const left = Math.max((window.screen.width - width) / 2, 0);
            const top = Math.max((window.screen.height - height) / 2, 0);
            window.open(shareUrl, 'sharekit', `toolbar=0,status=0,width=${width},height=${height},top=${top},left=${left}`);
        };

        const copyToClipboard = async (button, metadata) => {
            try {
                await navigator.clipboard.writeText(metadata.url);
                const label = button.querySelector('[data-sharekit-label]');
                if (!label) {
                    return;
                }

                const original = label.textContent;
                label.textContent = button.dataset.sharekitCopiedLabel || 'Copied';
                window.setTimeout(() => {
                    label.textContent = original;
                }, 1600);
            } catch (error) {
                window.prompt('Copy this link:', metadata.url);
            }
        };

        const resolveMetadata = (root) => {
            const page = pageMetadata();

            return {
                url: root.dataset.sharekitUrl || page.url,
                title: root.dataset.sharekitTitle || page.title,
                text: root.dataset.sharekitText || page.text,
                description: root.dataset.sharekitDescription || page.description,
                image: root.dataset.sharekitImage || page.image,
                via: root.dataset.sharekitVia || '',
                hashtags: root.dataset.sharekitHashtags || ''
            };
        };

        const initRoot = (root) => {
            if (root.dataset.sharekitReady === 'true') {
                return;
            }

            const metadata = resolveMetadata(root);
            const popupWidth = Number(root.dataset.sharekitPopupWidth || 620);
            const popupHeight = Number(root.dataset.sharekitPopupHeight || 700);
            const usePopup = root.dataset.sharekitPopup !== 'false';
            const allowNative = root.dataset.sharekitNative === 'true' && typeof navigator.share === 'function';

            root.querySelectorAll(selectors.button).forEach((button) => {
                const network = button.dataset.sharekitNetwork;
                const href = buildUrl(network, metadata);
                button.dataset.sharekitCopiedLabel = root.dataset.sharekitCopiedLabel || 'Copied';

                if (button.tagName === 'A') {
                    button.setAttribute('href', href);
                }

                if (network === 'native') {
                    if (!allowNative) {
                        button.hidden = true;
                        return;
                    }

                    button.hidden = false;
                    button.addEventListener('click', async () => {
                        await navigator.share({
                            url: metadata.url,
                            title: metadata.title,
                            text: metadata.description || metadata.text || metadata.title
                        });
                    });

                    return;
                }

                if (network === 'copy') {
                    button.addEventListener('click', () => copyToClipboard(button, metadata));
                    return;
                }

                if (button.tagName !== 'A') {
                    button.addEventListener('click', () => {
                        if (usePopup && network !== 'email') {
                            popup(href, popupWidth, popupHeight);
                            return;
                        }

                        window.location.href = href;
                    });
                }
            });

            root.dataset.sharekitReady = 'true';
        };

        window.Sharekit = {
            init(scope = document) {
                scope.querySelectorAll(selectors.root).forEach(initRoot);
            }
        };

        document.addEventListener('DOMContentLoaded', () => window.Sharekit.init());
        document.addEventListener('livewire:navigated', () => window.Sharekit.init());
    })();
</script>
