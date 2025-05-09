document.addEventListener('DOMContentLoaded', () => {
    document.body.addEventListener('change', event => {
        if (!event.target.matches('select[name$="[recipeIngredient]"]')) return;
        const select = event.target;
        
        const prefix = select.name.replace(/\[recipeIngredient\]$/, '');
        const amountInput = document.querySelector(`input[name="${prefix}[amount]"]`);
        const unitInput = document.querySelector(`input[name="${prefix}[unit]"]`);

        const { amount = '', unit = '' } = select.selectedOptions[0].dataset;
        amountInput.value = amount;
        unitInput.value   = unit;
    });
});
