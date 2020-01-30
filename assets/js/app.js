/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';
import '../css/base.scss';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from 'jquery';

const formSignUp = document.getElementById('js-form-up');
const formSignIn = document.getElementById('js-form-in');

const signUpButton = document.getElementById('js-sign-up');
const signInButton = document.getElementById('js-sign-in');

const closeSUBtn = document.getElementById('js-close-sign-up');
const closeSIBtn = document.getElementById('js-close-sign-in');

// toggle sign up form
    signUpButton.addEventListener('click', () => {
    formSignUp.classList.toggle('closed');
    formSignIn.classList.add('closed');
});
// toggle sign in form
    signInButton.addEventListener('click', () => {
    formSignIn.classList.toggle('closed');
    formSignUp.classList.add('closed');
});


closeSUBtn.addEventListener('click', () => {
    formSignUp.classList.add('closed');
    formSignIn.classList.add('closed')
});

closeSIBtn.addEventListener('click', () => {
    formSignUp.classList.add('closed');
    formSignIn.classList.add('closed')
});

