
<template>

    <div class="clearfix slidebox">
        <a @click="prev" class="slider-button pull-left text-center btn btn-primary btn-xs">
            <span class="fa fa-caret-left"></span>
        </a>
        <a @click="next" class="slider-button pull-right text-center btn btn-primary btn-xs">
            <span class="fa fa-caret-right"></span>
        </a>

        <transition-group name="fade" tag="div" class="slidebox">
            <div v-for="number in [currentNumber]" :key="number" v-html="currentSlide" class="slidebox-content"></div>
        </transition-group>
    </div>

</template>

<script>

    export default {

        props: ['slides'],

        data: function() {
            return {
                currentNumber: 0,
                timer: null
            }
        },

        methods: {
            next: function() {
                this.currentNumber += 1
            },
            prev: function() {
                this.currentNumber -= 1
            }
        },

        computed: {
        	currentSlide: function() {
                return this.slides[Math.abs(this.currentNumber) % this.slides.length];
            }
        }

    }

</script>

<style scoped>

    .fade-enter-active, .fade-leave-active {
        transition: all 0.8s ease;
        overflow: hidden;
        visibility: visible;
        opacity: 1;
        position: absolute;
    }

    .fade-enter, .fade-leave-to {
        opacity: 0;
        visibility: hidden;
    }

    .slidebox {
        padding-bottom: 2rem;
        min-height: 200px;
        width: 100%;
    }

    .slidebox-content {
        width: inherit;
    }

    .slider-button {
        display: block;
        height: 100%;
        width: 10%;
        z-index: 1;
    }

</style>
