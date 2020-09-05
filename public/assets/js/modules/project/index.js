'use strict';

let UIController = (() => {
    let DOMstrings = {
        clickableRow: '.clickable__row',
        statusColor: '.status__color',
        priorityColor: '.priority__color'
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

    let setupStatusColors = () => {
        document.querySelectorAll(DOM.statusColor).forEach(item => {
            switch( parseInt(item.dataset.status_id) ) {
                case 1: item.classList.add('active'); break;
                case 2: item.classList.add('inprocessing'); break;
                case 3: item.classList.add('waiting'); break;
                case 4: item.classList.add('done'); break;
                case 5: item.classList.add('suspend'); break;
                case 6: item.classList.add('in-planning'); break;
            }
        });
    }

    let setupPriorityColors = () => {
        document.querySelectorAll(DOM.priorityColor).forEach(item => {
            switch( parseInt(item.dataset.priority_id) ) {
                case 1: item.classList.add('very-high'); break;
                case 2: item.classList.add('high'); break;
                case 3: item.classList.add('normal'); break;
                case 4: item.classList.add('low'); break;
            }
        });
    }

    return {
        init: () => {
            console.log('Project-Index-Script has started');
            setupEventListeners();
            setupStatusColors();
            setupPriorityColors();
        }
    }
})(UIController);

BaseController.init();