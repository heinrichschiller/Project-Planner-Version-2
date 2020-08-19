'use strict';

let UIController = (() => {
    let DOMstrings = {
        clickableRow: '.clickable__row',
    }

    return {
        getInput: () => {
            return {
                // some code here
            }
        },

        getDOMstrings: () => {
            return DOMstrings;
        }
    }
})();

let BaseController = ((UICtrl) => {

    let DOM = UICtrl.getDOMstrings();

    let setupEventListeners = () => {
        document.querySelectorAll(DOM.clickableRow).forEach(item => {
            item.addEventListener('click', () => {
                window.location = item.dataset.href;
            })
        });        
    }

    return {
        init: () => {
            console.log('Project-Index-Script has started');
            setupEventListeners();
        }
    }
})(UIController);

BaseController.init();