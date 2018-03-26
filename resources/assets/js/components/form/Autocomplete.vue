
<template>

    <div class="form-group" v-bind:class="{ open : openSuggestion }">

        <label v-if="label">
            {{ label }}
        </label>

        <input
            type="text"
            class="form-control"
            v-model="display"
            @input="updateValue($event.target.value)"
            :placeholder="placeholder"
            @keydown.enter="enter"
            @keydown.down="down"
            @keydown.up="up"
            ref="input" />
        <input :name="name" type="hidden" :value="value">

        <ul class="dropdown-menu" style="width:100%">
            <li v-for="(suggestion, key) in matches"
                :key="key"
                v-bind:class="{'active': isActive(key)}"
                @click.prevent="select(suggestion)">

                <a href="#">{{ suggestion.value }}</a>
            </li>
        </ul>

    </div>

</template>

<script>

    export default {

        props: {
            label: {
                type: String
            },
            suggestions: {
                type: Array,
                required: true
            },
            placeholder: {
                default: 'Rechercher'
            },
            initialValue: {
                type: [String, Number]
            },
            initialDisplay: {
                type: String
            },
            name: {
                type: String
            },
        },
        // ['selection'],

        data () {
            return {
                value: null,
                display: null,
                selectedId: null,
                selectedDisplay: null,
                open: false,
                current: 0
            }
        },

        computed: {
            // Filtering the suggestion based on the input
            matches () {
                if (this.display == undefined || this.display == '') {
                    return [];
                }

                return this.suggestions.filter((obj) => {
                    return obj.value.toLowerCase().indexOf(this.display.toLowerCase()) >= 0
                })
            },

            openSuggestion () {
                return this.selection !== '' &&
                    this.matches.length !== 0 &&
                    this.open === true
            },
        },

        methods: {
            // Triggered the input event to cascade the updates to parent component
            updateValue (value) {
                if (this.open === false) {
                    this.open = true
                    this.current = 0
                }

                this.value = value
            },

            // When enter key pressed on the input
            enter () {
                this.value = this.matches[this.current].value;
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
            select (object) {
                if (!object) {
                    return
                }

                this.display = object.value
                this.value = (this.matches && object[this.matches]) ? object[this.matches] : object.key
                this.$emit('input', this.value)
                this.close()

                this.$emit('updateSelection', {
                    key: this.value
                })
            },

            close () {
                this.open = false
            }
        },

        mounted() {
            this.value = this.initialValue
            this.display = this.initialDisplay
            this.selectedDisplay = this.initialDisplay
        }

    }

</script>
