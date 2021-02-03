'use strict'

let UIController = (() => {
    let DOMstrings = {
        clickableRow:   '.clickable__row',
        editBtn:        'edit__btn',
        newNoteBtn:     'new__note__btn',
        noteClose:      'note__close',
        noteDesc:       'note__desc',
        noteForm:       'note__form',
        noteSave:       'note__save',
        modalTitle:     'modal__title',
        statusColor:    '.status__color',
        priorityColor:  '.priority__color',
        projectId:      'project__id'
    }

    return {
        getDOMStrings: () => {
            return DOMstrings;
        },

        createCard: (counter, title, description) => {
            return `
                <div class="card">
                    <div class="card-header" id="heading${counter}">
                        <h2 class="mb-0">
                            <button 
                                class="btn btn-link btn-block text-left" 
                                type="button" 
                                data-toggle="collapse" 
                                data-target="#collapse${counter}" 
                                aria-expanded="true" aria-controls="collapse${counter}">
                                ${title}
                            </button>
                        </h2>
                    </div>
        
                    <div 
                        id="collapse${counter}" 
                        class="collapse" 
                        aria-labelledby="heading${counter}" 
                        data-parent="#accordeon"
                        >
                        <div class="card-body">
                            ${description}
                        </div>
                    </div>
                </div>
            `;
        }
    }
})();

let Controller = ((UICtrl) => {

    let DOM = UICtrl.getDOMStrings();

    let setupEventListeners = () => {

        document.querySelectorAll(DOM.clickableRow).forEach(item => {
            item.addEventListener('click', () => {
                window.location = item.dataset.href;
            })
        });        

        document.getElementById(DOM.editBtn).addEventListener('click', () => {
            let editBtn = document.getElementById(DOM.editBtn);

            if (null !== editBtn) {
                window.location = editBtn.dataset.location;
            }
        });

        document.getElementById(DOM.newNoteBtn).addEventListener('click', () => {
            let modal = document.querySelector('.modal');
            let modalTitle = document.getElementById(DOM.modalTitle);

            let date = new Date;
            let currentDate = date.getHours() 
                + ':' + date.getMinutes() 
                + ' ' + date.getDay() 
                + '.' + date.getMonth() 
                + '.' + date.getFullYear();

            modalTitle.setAttribute('placeholder', currentDate);

            modal.style.display = 'block';
        });

        document.forms['note'].addEventListener('submit', (e) => {
            e.preventDefault();

            let desc = document.getElementById(DOM.noteDesc);
            let form = document.forms[DOM.noteForm];
            let modal = document.querySelector('.modal');

            let formData = new FormData(form);
            let request = new XMLHttpRequest();

            request.open('POST', form.action);
            request.send(formData);

            createAccordeonNotes();

            desc.value = '';
            modal.style.display = 'none';
        });

        document.addEventListener('DOMContentLoaded', () => {
            createAccordeonNotes();
        });

        document.getElementById(DOM.noteClose).addEventListener('click', () => {
            let modal = document.querySelector('.modal');

            modal.style.display = 'none';
        });

    }

    let createAccordeonNotes = () => {
        const accordeon = document.getElementById('accordeon');

        if (accordeon.hasChildNodes) {
            while (accordeon.firstChild) {
                accordeon.firstChild.remove();
            }
        }
        
        let request = new XMLHttpRequest();

        request.onload = () => {
            if( 200 === request.status ) {
                let result;

                if ( 'json' === request.responseType ) {
                    result = request.response;
                } else {
                    result = JSON.parse(request.responseText);
                }

                let notes = result.notes;

                for(let i = 0; i < notes.length; i++ ) {
                    let description = notes[i].description;
                    let title = notes[i].title;

                    if( "" === title) {
                        title = description;
                    }

                    accordeon.innerHTML += UICtrl.createCard(i, title, description);
                    console.log(notes[i]);
                }
                
                
            }
        };

        let projectId = document.getElementById(DOM.projectId).innerHTML;

        request.open('GET', '../../api/project/notes/' + projectId, true);
        request.responseType = 'json';
        request.getResponseHeader('Accept', 'application/json');
        request.send();
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
            console.log('Project-Read-Script has started');

            setupEventListeners();
            setupStatusColors();
            setupPriorityColors();
        }
    }
})(UIController);

Controller.init();