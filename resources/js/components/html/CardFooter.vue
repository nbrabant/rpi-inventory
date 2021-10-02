
<template>

    <div class="footer clearfix">

        <hr v-if="noHr !== true">

        <div class="stats" v-if="updatedAt">
            <i class="fa fa-clock-o"></i> Dernière modification le {{ updatedAt | date-time }}
        </div>

        <div class="stats" v-if="createdAt">
            <i class="fa fa-clock-o"></i> Créé le le {{ createdAt  | date-time }}
        </div>

        <button type="submit" class="pull-right" v-bind:class="submitBtn">
            <i v-bind:class="submitIcon"></i>
            {{ submitText }}
        </button>

    </div>

</template>



<script>

    export default {
        props: [
            'noHr',
            'updatedAt',
            'createdAt',
            'submitBtn',
            'submitIcon',
            'submitText'
        ],
    }

</script>
