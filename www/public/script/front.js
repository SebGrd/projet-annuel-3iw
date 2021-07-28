const burgerBtn = document.getElementById('burger-btn');

burgerBtn.addEventListener('click', (e) => {
    if (burgerBtn.classList.contains('header__menu__burger--opened')) { // close
        burgerBtn.classList.remove('header__menu__burger--opened');
        document.getElementById('header-nav').style.display = '';
    } else { // open
        burgerBtn.classList.add('header__menu__burger--opened');
        document.getElementById('header-nav').style.display = 'block'
    }
})


const appButtons = document.querySelectorAll('.app__sidemenu__list__item__button');
const appLists = document.querySelectorAll('.app__products__list');

appButtons.forEach((button) => {
    button.addEventListener('click', () => {
        appButtons.forEach((button) => {
            button.classList.remove('app__sidemenu__list__item__button--active')
        })
        button.classList.add('app__sidemenu__list__item__button--active')
        const [list] = [...appLists].filter((element) => element.dataset.id === button.dataset.id);
        appLists.forEach((list) => {
            list.classList.add('app__products__list--hidden')
        })
        list.classList.remove('app__products__list--hidden')
    })
})


const profileMenuBtn = document.getElementById('profile-menu-button');
const profileMenu = document.getElementById('profile-menu');
profileMenuBtn.addEventListener('click', () => {
    profileMenu.classList.toggle('header__profile__menu--hidden');
})

const cartBtn = document.getElementById('cart-btn');
const cart = document.getElementById('cart');
cartBtn.addEventListener('click', () => {
    cart.classList.toggle('header__cart__cart--hidden');
})

const addToCartButtons = document.querySelectorAll('.featured__card__footer__cart');

addToCartButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const {productid, productprice, productname} = button.dataset;
        addProductToLocalStorage({productid, productprice, productname})
        updateCart();
    })
})

const addProductToLocalStorage = (product) => {
    if (localStorage.getItem(`product-${product.productid}`)) {
        const storedProduct = JSON.parse(localStorage.getItem(`product-${product.productid}`));
        localStorage.setItem(`product-${product.productid}`, JSON.stringify({
            id: product.productid,
            name: product.productname,
            price: product.productprice,
            quantity: parseInt(storedProduct.quantity) + 1,
        }))
    } else {
        localStorage.setItem(`product-${product.productid}`, JSON.stringify({
            id: product.productid,
            name: product.productname,
            price: product.productprice,
            quantity: 1,
        }))
    }
    updateFormInput();
}

const removeProductFromLocalStorage = (productId) => {
    if (localStorage.getItem(`product-${productId}`)) {
        localStorage.removeItem(`product-${productId}`)
    }
    updateFormInput();
}

const updateFormInput = () => {
    document.getElementById('cart-form-input').value = JSON.stringify(getLocalStorageProducts());
}
const getLocalStorageProducts = () => {
    const productsIds = Object.keys(localStorage).filter((localKey) => localKey.startsWith('product-'))
    return productsIds.map((productId) => JSON.parse(localStorage.getItem(productId)))
}
const updateCart = () => {
    const cartList = document.getElementById('cart-list');
    const products = getLocalStorageProducts();
    cartList.innerHTML = '';
    if (!products.length) {
        cartList.innerHTML = '';
        const item = document.createElement('li')
        item.classList.add('header__cart__cart__list__item')
        item.innerHTML = `<span>Le panier est vide.</span>`;
        cartList.appendChild(item);
    }
    products.forEach((product) => {
        const item = document.createElement('li')
        item.classList.add('header__cart__cart__list__item')
        item.innerHTML = `
            <span class="header__cart__cart__list__item__quantity">x${product.quantity}</span>
            <span class="header__cart__cart__list__item__name">${product.name}</span>
            <span class="header__cart__cart__list__item__price">${product.price}€</span>
            <span class="header__cart__cart__list__item__remove">
                <button class="header__cart__cart__list__item__remove__button" data-productid="${product.id}">X</button>
            </span>
        `;
        cartList.appendChild(item);
        const removeButtons = document.querySelectorAll('.header__cart__cart__list__item__remove__button');
        removeButtons.forEach((removeBtn) => {
            removeBtn.addEventListener('click', () => {
                removeProductFromLocalStorage(removeBtn.dataset.productid);
                updateCart();
            })
        })
    })
    const total = document.getElementById('cart-total');
    const totalPrice = products.reduce(((previousValue, currentValue) => previousValue + (parseFloat(currentValue.price) * parseFloat(currentValue.quantity))), 0)
    total.innerText = `${totalPrice}€`
}

updateFormInput();
updateCart();


const nextStepBtn = document.getElementById('next-step');
const steps = document.querySelectorAll('.invoice__step');
const stepsDisplay = document.querySelectorAll('.invoice__steps__list__item');
let stepNbr = 1;
const updateSteps = () => {
    steps.forEach((step) => {
        step.classList.add('invoice__step--hidden')
    })
    const [ mainStep ] = [...steps].filter((step) => parseInt(step.dataset.step) === stepNbr)
    mainStep.classList.remove('invoice__step--hidden');
}
const updateStepsDisplay = () => {
    const pastStepDisplay = [...stepsDisplay].filter((step) => parseInt(step.dataset.step) <= stepNbr)
    const [ currentStepDisplay ] = [...stepsDisplay].filter((step) => parseInt(step.dataset.step) === stepNbr)
    stepsDisplay.forEach((stepsDisplay) => {
        stepsDisplay.classList.remove('invoice__steps__list__item--active')
    })
    pastStepDisplay.forEach((pastStep) => {
        pastStep.classList.add('invoice__steps__list__item--active')
        pastStep.classList.remove('invoice__steps__list__item--current')
    })
    currentStepDisplay.classList.add('invoice__steps__list__item--active')
    currentStepDisplay.classList.add('invoice__steps__list__item--current')
    if (stepNbr === 3) {
        nextStepBtn.style.display = 'none'
    } else {
        nextStepBtn.style.display = 'inline-block'
    }
}
nextStepBtn.addEventListener('click', () => {
    if (stepNbr !== 3) {
        stepNbr++;
        updateStepsDisplay();
        updateSteps();
    } else {
        alert('oui')
    }
})
stepsDisplay.forEach((stepsDisplay) => {
    stepsDisplay.addEventListener('click', () => {
        stepNbr = parseInt(stepsDisplay.dataset.step);
        updateStepsDisplay();
        updateSteps();
    })
})

const commandForm = document.querySelector('.invoice__step--form form');
commandForm.addEventListener('submit', (e) => {
    e.preventDefault();
})