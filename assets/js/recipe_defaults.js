document.addEventListener('DOMContentLoaded', () => {
    function addDefaultsForSelect(select) {
        const prefix = select.name.replace(/\[recipeIngredient\]$/, '');
        const amountInput = document.querySelector(`input[name="${prefix}[amount]"]`);
        const unitInput = document.querySelector(`input[name="${prefix}[unit]"]`);

        const { amount = '', unit = '' } = select.selectedOptions[0].dataset;
        amountInput.value = amount;
        unitInput.value   = unit;        
    };

    document.body.addEventListener('change', event => {
        if (!event.target.matches('select[name$="[recipeIngredient]"]')) return;
        addDefaultsForSelect(event.target);
    });

    const observer = new MutationObserver(mutations => {
        for (const { addedNodes } of mutations) {
            for (const node of addedNodes) {
                if (node.nodeType !== Node.ELEMENT_NODE) continue;
                
                node.querySelectorAll('select[name$="[recipeIngredient]"]').forEach(addDefaultsForSelect);
            }
        }
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
});
