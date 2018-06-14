
<template>

    <form v-on:submit.prevent="submitForm">

        <div class="card">
            <html-cardheader
                title="nouvelle opération"></html-cardheader>

            <div class="content">
                <div class="clearfix">
                    <form-hidden v-model="item.product_id"
                        :item="productId"
                        :error="errors.product_id"></form-hidden>

                    <div class="col-md-6">
                        <form-text label="Quantité"
                            v-model="item.quantity"
                            :item="item.quantity"
                            :error="errors.quantity"></form-text>
                    </div>

                    <div class="col-md-6">
                        <form-select label="Opération"
                            :options="operations"
                            v-model="item.operation"
                            :item="item.operation"
                            :error="errors.operation"></form-select>
                    </div>

                    <div class="col-md-12">
                        <form-text label="Détail de l'opération"
                            v-model="item.detail"
                            :item="item.detail"
                            :error="errors.detail"></form-text>
                    </div>
                </div>

                <html-cardfooter :no-hr="true"
                    :submit-btn="submitBtn"
                    :submit-icon="submitIcon"
                    :submit-text="submitText"></html-cardfooter>
            </div>
        </div>

    </form>

</template>

<script>

    module.exports = RestShow.extend({

        props: ['productId'],

        computed: {
            // override to escape the parent mounted request
            endpoint: function () {
                return;
            },
            operations: function () {
                return [
                    {'key': '-', 'value': 'retrait'},
                    {'key': '+', 'value': 'ajout'},
                ];
            }
        },

        mounted: function() {
            if (this.productId == null) return

            this.item.product_id = this.productId

            this.triggerRestGet('consumptions/create', {product_id: this.productId}, this.item)
        },

        methods: {
            submitForm: function () {
                this.triggerRestSave('consumptions', {}, this.item)

                // @TODO : on response, bind the new element to the parent component
            },
        }

    });

</script>
