
<template>

    <div class="form-group" v-bind:class="{ 'has-error': error }">

        <label v-if="label">
            {{ label }}
        </label>

        <input type="file" classv-model="item" v-on:change="updatePreview">

        <div v-if="this.item || this.temporary_image" class="preview_image">
            <img class="img-responsive center-block" v-bind:src="imageSrc"/>
        </div>

        <span class="help-block">{{ error }}</span>

    </div>

</template>

<script>

    export default {

        data: function () {
            return {
                time: "?"+ new Date().getTime(),
                temporary_image: null
            }
        },

        props: {
            id: null,
            path: null,
            label: null,
            item: null,
            error: null,
            imagesrc: ''
        },

        computed: {
            imageSrc: function() {
                if(this.temporary_image != null && typeof this.temporary_image != "undefined")
                {
                    var render = this.temporary_image;
                }
                else
                {
                    var render = this.path + "/" + this.id + "." + this.item;

                    if(this.time != null && typeof this.time != "undefined")
                    {
                        render += this.time;
                    }
                }

                this.$emit('updateImageSrc', render)

                return render;
            }
        },

        methods: {
            getInput: function(msg, event) {
                return this.$el.querySelectorAll("input[type='file']");
            },
            updatePreview: function(msg, event) {
                var input = this.getInput();

                if (input[0].files && input[0].files[0]) {
                    var type = input[0].files[0].type.split("/");

                    if(type[0] == "image")
                    {
                        var reader = new FileReader();

                        var component = this;
                        reader.onload = function (e) {
                            component.temporary_image = e.target.result;
                        };

                        reader.readAsDataURL(input[0].files[0]);
                    }
                    else
                    {
                        swal("Mauvais format", null, 'error')
                        input[0].value = "";
                    }
                }
            },
            refreshImage: function(msg, event)
            {
                this.time = "?"+ new Date().getTime();
            }
        },

        events: {
            'reset-upload': function() {
                this.temporary_image = null;
                this.item = null;
                $("input[type='file']").val("");
            },
        }

    }

</script>

<style scoped>

    .form-control {
        font-size: 14px;
        line-height: 22px;
    }

    /* input {
        display: none;
    } */

    .preview_image
    {
        margin-top: 20px;
    }

</style>
