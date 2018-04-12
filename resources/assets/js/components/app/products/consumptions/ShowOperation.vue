
<template>

    <div class="content">
        <div class="clearfix">
            <div class="col-sm-4">Date</div>
            <div class="col-sm-8">{{ operation.created_at | datetime }}</div>
        </div>
        <div class="clearfix">
            <div class="col-sm-4">Détail</div>
            <div class="col-sm-8">{{ operation.detail }}</div>
        </div>
        <div class="clearfix">
            <div class="col-sm-4">Type d'opération</div>
            <div class="col-sm-8">{{ operation.operation | type-operation }}</div>
        </div>
        <div class="clearfix">
            <div class="col-sm-4">Quantité</div>
            <div class="col-sm-8">{{ operation.quantity }}</div>
        </div>
    </div>

</template>

<script>

    export default RestCore.extend({

        name: 'ShowOperation',

        props: ['operation'],

    });

</script>
