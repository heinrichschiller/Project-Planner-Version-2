'use strict';

let UIController = (() => {
    let DOMstrings = {
        clickableRow: '.clickable__row',
        priorityColor: '.priority__color'
    }

    return {
        getDomStrings: () => {
            return DOMstrings;
        }
    }
})();

let BaseController = ((UICtrl) => {

    let DOM = UICtrl.getDomStrings();

    let setupEventListeners = () => {
        document.querySelectorAll(DOM.clickableRow).forEach(item => {
            item.addEventListener('click', () => {
                window.location = item.dataset.href;
            })
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
            console.log('Dashboard-Script has started');
            setupEventListeners();
            setupPriorityColors();
        }
    }
})(UIController);

BaseController.init();