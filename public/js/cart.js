document.addEventListener('DOMContentLoaded', function () {
    const cartAddUrl = document.querySelector('meta[name="cart-add-url"]').content;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    let orderCount = 0; // Track successful orders for alert
    let lastAlertTime = 0; // Timestamp of last alert
    let alertTimeout = null; // Timeout reference

    document.querySelectorAll('.order-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const productId = this.getAttribute('data-product-id');

            // Disable button temporarily to prevent spam
            const button = this.querySelector('button');
            button.disabled = true;
            setTimeout(() => button.disabled = false, 500);

            fetch(cartAddUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const now = Date.now();
                    const timeDiff = now - lastAlertTime;

                    // Alert logic
                    if (timeDiff < 2000 && alertTimeout) {
                        orderCount++;
                        clearTimeout(alertTimeout);
                        document.querySelector('.alert-success')?.remove();
                    } else {
                        orderCount = 1;
                    }

                    const countText = orderCount > 1 ? ` (${orderCount}x)` : '';
                    const safeMessage = escapeHtml(data.message) + countText;

                    document.body.insertAdjacentHTML('beforeend', `
                        <div class="alert alert-success" role="alert" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
                            ${safeMessage}
                            <button type="button" class="btn-close" onclick="this.parentElement.remove();" aria-label="Close"></button>
                        </div>
                    `);

                    lastAlertTime = now;
                    alertTimeout = setTimeout(() => {
                        document.querySelector('.alert-success')?.remove();
                        orderCount = 0;
                    }, 3000);

                    // Update cart count only for new items
                    const cartCountEl = document.getElementById('cart-count');
                    if (data.isNewItem) {
                        let currentCount = parseInt(cartCountEl.textContent) || 0;
                        cartCountEl.textContent = currentCount + 1;
                    } else {
                        // Optionally, sync with server totalCount for accuracy
                        cartCountEl.textContent = data.totalCount;
                    }
                } else {
                    const safeMessage = escapeHtml(data.message || 'Failed to add to cart.');
                    document.body.insertAdjacentHTML('beforeend', `
                        <div class="alert alert-danger" role="alert" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
                            ${safeMessage}
                            <button type="button" class="btn-close" onclick="this.parentElement.remove();" aria-label="Close"></button>
                        </div>
                    `);
                    setTimeout(() => {
                        document.querySelector('.alert-danger')?.remove();
                    }, 3000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.body.insertAdjacentHTML('beforeend', `
                    <div class="alert alert-danger" role="alert" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
                        Failed to add to cart.
                        <button type="button" class="btn-close" onclick="this.parentElement.remove();" aria-label="Close"></button>
                    </div>
                `);
                setTimeout(() => {
                    document.querySelector('.alert-danger')?.remove();
                }, 3000);
            });
        });
    });
});