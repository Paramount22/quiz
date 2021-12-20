<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                       <h5>Online Examination</h5>

                        <span
                            class="text-right"
                            v-show="questionIndex !== questions.length" >
                           <strong>{{questionIndex + 1}} from {{questions.length}}</strong>
                        </span>

                    </div>
                    <div class="card-body">
                        <span class="text-right text-danger">{{time}}</span>

                        <div v-for="(question, index) in questions" :key="question.id">
                            <div v-show="index === questionIndex">
                                <strong>{{question.question}}</strong>
                                <ol class="list-group mb-4 mt-4">
                                    <li class="list-group-item"
                                        v-for="answer in question.answers" :key="answer.id">

                                        <label>
                                            <input type="radio"
                                               :value="answer.is_correct == true ? true : answer.answer"
                                                :name="index"
                                                v-model="userResponses[index]"
                                               @click="choices(question.id, answer.id)"
                                            >
                                            {{answer.answer}}
                                        </label>

                                    </li>
                                </ol>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between"
                             v-if="questionIndex !== questions.length">
                            <button class="btn btn-secondary" @click="prev" v-if="(questionIndex + 1) > 1">
                                Prev
                            </button>
                            <button class="btn btn-success" @click="next(); postUserChoice()">
                                Next
                            </button>
                        </div>

                        <div v-show="questionIndex === questions.length">
                            <p class="text-center">You got {{score()}} / {{questions.length}}</p>
                            <a href="/home">Home</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var moment = require('moment');
    export default {
        name: "QuizComponent",
        props: ['times', 'quizQuestions', 'quizId', 'hasQuizPlayed'],

        data() {
            return {
                questions: this.quizQuestions,
                questionIndex: 0,
                userResponses: Array(this.quizQuestions.length).fill(false),
                currentQuestion: 0,
                currentAnswer: 0,
                clock: moment(this.times * 60 * 1000),
            }
        },

        mounted() {
            setInterval(() => {
                this.clock = moment(this.clock.subtract(1, 'second'))
            }, 1000)
        },

        methods: {
            prev() {
                this.questionIndex--;
            },

            next() {
                this.questionIndex++;
            },

            choices(question, answer) {
                this.currentAnswer = answer;
                this.currentQuestion = question;
            },
            score() {
                return this.userResponses.filter( response => {
                    return response === true;
                }).length
            },
            postUserChoice() {
                axios.post('/result/store', {
                    answerId: this.currentAnswer,
                    questionId: this.currentQuestion,
                    quizId: this.quizId
                }).then(response => {
                   // console.log(response)
                }).catch(err => {
                    console.log(err)
                })
            }

        },

        computed: {
            time() {
                let minsec = this.clock.format('mm:ss');
                if (minsec == '00:00') {
                    alert('Timeout');
                    window.location.reload();
                }
                return minsec;
            }
        }
    }
</script>

<style scoped>

</style>
