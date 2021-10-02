
<template>

    <div class="form-group" v-bind:class="{ 'has-error': error }">

        <label v-if="label">
            {{ label }}
        </label>

        <input type="file" classv-model="item" :disabled="disabled">

        <div v-if="this.item || this.temporary_file" class="preview_image">
            <img class="img-responsive center-block" v-bind:src="fileSrc"/>
        </div>

        <span class="help-block">{{ error }}</span>

    </div>

</template>

<script>

    export default {

        data: function () {
            return {
                time: "?"+ new Date().getTime(),
                temporary_file: null
            }
        },

        props: {
            id: null,
            path: null,
            label: null,
            item: null,
        	error: null,
        },

        computed: {
            fileSrc: function() {
                if(this.temporary_file != null && typeof this.temporary_file != "undefined")
                {
                    var render = this.temporary_file;
                }
                else
                {
                    var render = this.path + "/" + this.id + "." + this.item;

                    if(this.time != null && typeof this.time != "undefined")
                    {
                        render += this.time;
                    }
                }

                return render;
            }
        },

        methods: {
            getInput: function(msg, event) {
                return this.$el.querySelectorAll("input[type='file']");
            },
            updatePreview: function() {
                var input = this.getInput();

                if (input[0].files && input[0].files[0]) {
                    var type = input[0].files[0].type.split("/");

                    if(type[0] == "image")
                    {
                        var reader = new FileReader();

                        var component = this;
                        reader.onload = function (e) {
                            component.temporary_file = e.target.result;
                        };

                        reader.readAsDataURL(input[0].files[0]);
                    }
                    else
                    {
                        swal.fire({
                            title: "Mauvais format",
                            icon: 'error'
                        });
                        input[0].value = "";
                    }
                }
            },
            refreshFile: function(msg, event)
            {
                this.time = "?"+ new Date().getTime();
            }
        },

    }

</script>

<style>

    .form-control {
        font-size: 14px;
        line-height: 22px;
    }

    .preview_file
    {
        margin-top: 20px;
    }

</style>
