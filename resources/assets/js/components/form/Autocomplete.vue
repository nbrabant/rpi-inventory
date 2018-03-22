
<template>

    <div class="form-group" v-bind:class="{ open : openSuggestion }">

        <label v-if="label">
            {{ label }}
        </label>

        <input
            type="text"
            class="form-control"
            :value="item"
            @input="updateValue($event.target.value)"
            :placeholder="placeholder"
            @keydown.enter="enter"
            @keydown.down="down"
            @keydown.up="up"
            ref="input" />

        <ul class="dropdown-menu" style="width:100%">
            <li v-for="(suggestion, index) in matches"
                v-bind:class="{'active': isActive(index)}"
                @click="suggestionClick(index)">

                <a href="#">{{ suggestion.value }}</a>
            </li>
        </ul>

    </div>

</template>

<script>

    export default {

        props: ['label', 'item', 'suggestions', 'selection', 'placeholder'],

        data () {
            return {
                open: false,
                current: 0
            }
        },

        computed: {
            // Filtering the suggestion based on the input
            matches () {
                return this.suggestions.filter((obj) => {
                    if (this.item == undefined || this.item == '') {
                        return false;
                    }

                    return obj.value.toLowerCase().indexOf(this.item.toLowerCase()) >= 0
                })
            },

            openSuggestion () {
                return this.selection !== '' &&
                    this.matches.length !== 0 &&
                    this.open === true
            }
        },

        methods: {
            // Triggered the input event to cascade the updates to parent component
            updateValue (item) {
                if (this.open === false) {
                    this.open = true
                    this.current = 0
                }

                this.item = item
            },

            // When enter key pressed on the input
            enter () {
                this.item = this.matches[this.current].value;
                this.open = false
            },

            // When up arrow pressed while suggestions are open
            up () {
                if (this.current > 0) {
                    this.current--
                }
            },

            // When down arrow pressed while suggestions are open
            down () {
                if (this.current < this.matches.length - 1) {
                    this.current++
                }
            },

            // For highlighting element
            isActive (index) {
                return index === this.current
            },

            // When one of the suggestion is clicked
            suggestionClick (index) {
                this.item = this.matches[index].value
                this.$emit('updateSelection', {
                    key: this.matches[index].key,
                })
                this.open = false

                return false;
            }

        }
    }

</script>
