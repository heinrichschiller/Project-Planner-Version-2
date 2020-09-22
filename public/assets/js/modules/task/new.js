'use strict'

let UIController = (() => {
    let DOMstrings = {
        
    }

    return {
        getInput: () => {
            title: document.getElementById(DOMstrings.taskTitle).value
        },

        getDOMstrings: () => {
            return DOMstrings;
        }
    }
})();

let Controller = ((UICtrl) => {

    let setupEventListeners = () => {

        let DOM = UICtrl.getDOMstrings();
    };

    return {
        init: () => {
            console.log('Task-New-Script has started.');
        }
    }
})(UIController);

Controller.init();