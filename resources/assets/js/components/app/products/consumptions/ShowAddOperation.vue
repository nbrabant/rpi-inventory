
<template>

    <form v-on:submit.prevent="submitForm" class="row">

        <form-hidden v-model="item.product_id"
            :item="productId"
            :error="errors.product_id"></form-hidden>

        <div class="col-md-4">
            <form-select placeholder="Opération"
            :options="operations"
            v-model="item.operation"
            :item="item.operation"
            :error="errors.operation"></form-select>
        </div>

        <div class="col-md-4">
            <form-text placeholder="Détail de l'opération"
                v-model="item.detail"
                :item="item.detail"
                :error="errors.detail"></form-text>
        </div>

        <div class="col-md-3">
            <form-text placeholder="Quantité"
                v-model="item.quantity"
                :item="item.quantity"
                :error="errors.quantity"></form-text>
        </div>

        <div class="col-md-1">
            <html-cardfooter :no-hr="true"
                :submit-btn="submitBtn"
                submit-icon="fa fa-plus"
                submit-text=""></html-cardfooter>
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
                // this.triggerRestSave('consumptions', {}, this.item)

                this.item.created = true;

                this.$parent.addConsumption(this.item)
            },
        }

    });

</script>
