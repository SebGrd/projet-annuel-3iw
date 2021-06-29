const ppButton = document.getElementById('pp-button');
const ppMenu = document.getElementById('pp-menu');

ppButton.addEventListener('click', (e) => {
    ppMenu.classList.toggle('header__menu__popup-menu--active')
})


// editor
const toolbox = {
    reset: document.getElementById('editor-action-reset'),
    bold: document.getElementById('editor-action-bold'),
    italic: document.getElementById('editor-action-italic'),
    link: document.getElementById('editor-action-link'),
    image: document.getElementById('editor-action-image'),
    h1: document.getElementById('editor-action-h1'),
    h2: document.getElementById('editor-action-h2'),
    h3: document.getElementById('editor-action-h3'),
    h4: document.getElementById('editor-action-h4'),
    h5: document.getElementById('editor-action-h5'),
};

const modifyTools = {
    reset: {
        el: toolbox.reset,
        tag: '',
    },
    bold: {
        el: toolbox.bold,
        tag: 'b',
    },
    italic: {
        el: toolbox.italic,
        tag: 'i',
    },
    h1: {
        el: toolbox.h1,
        tag: 'h1',
    },
    h2: {
        el: toolbox.h2,
        tag: 'h2',
    },
    h3: {
        el: toolbox.h3,
        tag: 'h3',
    },
    h4: {
        el: toolbox.h4,
        tag: 'h4',
    },
    h5: {
        el: toolbox.h5,
        tag: 'h5',
    },

};

function selection() {
    return window.getSelection().toString() ?? false;
}

const modifySelection = (tag) => {
    if (!selection()) return false;
    if (window.getSelection().baseNode.parentElement.tagName === tag.toUpperCase()) return false;
    console.log(window.getSelection().anchorNode.parentNode)
    if (!tag) {
        const text = document.createTextNode(selection())
        const range = window.getSelection().getRangeAt(0)
        range.deleteContents()
        range.insertNode(text);
    } else {
        const el = document.createElement(tag);
        el.innerText = selection();
        const range = window.getSelection().getRangeAt(0)
        range.deleteContents()
        range.insertNode(el);
    }
}

Object.keys(modifyTools).forEach((key) => {
    modifyTools[key].el.addEventListener('click', () => {
        if (selection()) {
            console.log(window.getSelection())
            modifySelection(modifyTools[key].tag)
        }
    })
})

