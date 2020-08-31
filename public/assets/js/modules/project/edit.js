'use strict'

let UIController = (() => {
    let DOMstrings = {
        status: 'input__status',
        priority: 'input__priority'
    }

    return {
        getDOMStrings: () => {
            return DOMstrings;
        }
    }
})();

let Controller = ((UICtrl) => {

    let DOM = UICtrl.getDOMStrings();

    let setupStatusField = () => {
        let DOMstatus = document.getElementById(DOM.status);

        DOMstatus.value = DOMstatus.dataset.status_id;
    };

    let setupPriorityField = () => {
        let DOMpriority = document.getElementById(DOM.priority);

        DOMpriority.value = DOMpriority.dataset.priority_id;
    };

    return {
        init: () => {
            console.log('Project-Edit-Script has started');
            setupStatusField();
            setupPriorityField();
        }
    }
})(UIController);

Controller.init();