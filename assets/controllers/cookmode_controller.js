import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["overlay", "step", "ingredients", "pageNumber", "prevButton", "nextButton"];
    static values = { steps: Array, servings: Number };

    initialize() {
        this.index = 0;
    }

    connect() {
        this.updateView();
    }
    
    toggle() {
        this.overlayTarget.classList.toggle('hidden');
    }

    prevStep() {
        if(this.index > 0) {
            this.index--;
            this.updateView();
        }
    }

    nextStep() {
        if(this.index < this.stepsValue.length-1) {
            this.index++;
            this.updateView();
        }
    }

    updateView() {
        this.updateStepIngredients();
        this.updateStepDescription();
        this.updatePageNumber();
        this.updateButtons();
    }

    updateStepDescription() {
        this.stepTarget.textContent = this.stepsValue[this.index].instruction;
    }

    updateStepIngredients() {
        const ingredientsString = this.stepsValue[this.index].stepIngredients
            .map(ingredient => {
                const amount = ingredient.amount ? ingredient.amount / 4 * this.servingsValue : '';
                const unit = ingredient.unit ? ingredient.unit : '';
                return `${amount} ${unit} ${ingredient.name}`;
            })
            .join(', ');
        this.ingredientsTarget.textContent = ingredientsString;
    }

    updatePageNumber() {
        this.pageNumberTarget.textContent = `Schritt ${this.index + 1} von ${this.stepsValue.length}`;
    }

    updateButtons() {
        this.prevButtonTarget.classList.toggle('invisible', this.index === 0);
        this.nextButtonTarget.classList.toggle('invisible', this.index === this.stepsValue.length - 1);
    }
}