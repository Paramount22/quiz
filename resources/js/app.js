require('./bootstrap');

import Vue from 'vue';
import Example from './components/example';
import QuizComponent from './components/QuizComponent';


const app = new Vue({
    el: '#app',
    components: {Example, QuizComponent}
});
