'use strict'

let UIController = (() => {
    let DOMstrings = {
        contact: 'input__contact',
        project: 'input__project'
    }

    return {
        getDOMStrings: () => {
            return DOMstrings;
        }
    }
})();

let Controller = ((UICtrl) => {

    let DOM = UICtrl.getDOMStrings();

    let setupContactField = () => {
        let DOMcontact = document.getElementById(DOM.contact);

        DOMcontact.value = DOMcontact.dataset.contact_id;
    };

    let setupProjectField = () => {
        let DOMproject = document.getElementById(DOM.project);

        DOMproject.value = DOMproject.dataset.project_id;
    };

    return {
        init: () => {
            console.log('Project-Edit-Script has started');
            setupContactField();
            setupProjectField();
        }
    }
})(UIController);

Controller.init();