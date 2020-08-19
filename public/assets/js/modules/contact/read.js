'use strict'

let UIController = (() => {
    let DOMstrings = {
        editBtn: 'edit__btn'
    }

    return {
        getDOMStrings: () => {
            return DOMstrings;
        }
    }
})();

let Controller = ((UICtrl) => {

    let DOM = UICtrl.getDOMStrings();

    let setupEventListeners = () => {

        document.getElementById('edit__btn').addEventListener('click', () => {
            let editBtn = document.getElementById('edit__btn');

            if (editBtn !== null) {
                window.location = editBtn.dataset.location;
            }
        });
    }

    return {
        init: () => {
            console.log('Task-Read-Script has started');
            setupEventListeners();
        }
    }
})(UIController);

Controller.init();