'use strict'

let UIController = (() => {
    let DOMstrings = {
        editBtn:        'edit__btn',
        newNoteBtn:     'new__note__btn',
        noteClose:      'note__close',
        noteDesc:       'note__desc',
        noteForm:       'note__form',
        noteSave:       'note__save',
        modalTitle:     'modal__title',
        projectId:      'project__id',
        taskId:         'task__id'
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
                            <button class="btn 
                                btn-link 
                                btn-block 
                                text-left" 
                                type="button" 
                                data-toggle="collapse" 
                                data-target="#collapse${counter}" 
                                aria-expanded="true" 
                                aria-controls="collapse${counter}"
                                >
                                ${title}
                            </button>
                        </h2>
                    </div>
        
                    <div id="collapse${counter}" class="collapse" 
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

        document.getElementById(DOM.editBtn).addEventListener('click', () => {
            let editBtn = document.getElementById(DOM.editBtn);

            if (editBtn !== null) {
                window.location = '/task/edit/' + editBtn.dataset.id;
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

            const desc = document.getElementById(DOM.noteDesc);
            const form = document.forms[DOM.noteForm];
            const modal = document.querySelector('.modal');
            const title = document.getElementById(DOM.modalTitle);

            let formData = new FormData(form);
            let request = new XMLHttpRequest();

            request.open('POST', form.action);
            request.send(formData);

            createAccordeonNotes();

            desc.value = '';
            title.value = '';
            modal.style.display = 'none';
        });

        document.addEventListener('DOMContentLoaded', () => {
            createAccordeonNotes();
        });

        document.getElementById(DOM.noteClose).addEventListener('click', () => {
            let modal = document.querySelector('.modal');

            modal.style.display = 'none';
        });

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
    
            let projectId = document.getElementById(DOM.projectId).value;
            let taskId = document.getElementById(DOM.taskId).innerHTML;
    
            request.open('GET', '../../api/project/task/notes/' + projectId + '/' + taskId, true);
            request.responseType = 'json';
            request.getResponseHeader('Accept', 'application/json');
            request.send();
        }
    }

    return {
        init: () => {
            console.log('Task-Read-Script has started');
            setupEventListeners();
        }
    }
})(UIController);

Controller.init();