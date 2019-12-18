
<template>

    <nav class="navbar navbar-default navbar-fixed">
        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a v-if="breadcrumbs[0]" class="navbar-brand" v-link="breadcrumbs[0].route">
                    <i v-if="breadcrumbs[0].icon" :class="'fa fa-fw fa-' + breadcrumbs[0].icon"></i>
                    {{ breadcrumbs[0].title | truncate }}
                </a>
            </div>

            <div class="collapse navbar-collapse">

                <ul class="nav navbar-nav navbar-left">
                    <li v-for="route in breadcrumbs.slice(1)">
                        <a v-link="route.route">
                            <i v-if="route.icon" :class="'fa fa-fw fa-' + route.icon"></i>
                            {{ route.title | truncate }}
                        </a>
                    </li>
                </ul>

            </div>

        </div>
    </nav>

</template>



<script>

    export default {
        props: ['breadcrumbs'],
    }

</script>
