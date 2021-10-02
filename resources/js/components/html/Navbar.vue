
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

                <div class="breadcrumb">
                    <ul>
                        <li
                            v-for="(breadcrumb, idx) in breadcrumbList"
                            :key="idx"
                            @click="routeTo(idx)"
                            :class="{'linked': !!breadcrumb.link}">

                            <i v-if="breadcrumb.icon" :class="'fa fa-fw fa-' + breadcrumb.icon"></i>
                            {{breadcrumb.name}}

                        </li>
                    </ul>
                </div>
            </div>

            <div class="collapse navbar-collapse">

                <ul class="nav navbar-nav navbar-left">
                    <!-- <li v-for="route in breadcrumbList.slice(1)">
                        <a v-link="route.link">
                            <i v-if="route.icon" :class="'fa fa-fw fa-' + route.icon"></i>
                            {{ route.name | truncate }}
                        </a>
                    </li> -->
                </ul>

            </div>

        </div>
    </nav>

</template>



<script>

    export default {

        props: ['breadcrumbList'],
        
        methods: {
            routeTo: function(pRouteTo) {
                if (this.breadcrumbList[pRouteTo].link) 
                    this.$router.push(
                        this.breadcrumbList[pRouteTo].link
                    )
            }
        }

    }

</script>

<style scoped>
    .breadcrumb {
        background-color: transparent;
        color: rgba(0, 0, 0, 0.5);
    }

    .breadcrumb ul li {
        display: inline;
    }

    .breadcrumb ul li:after {
        content: " | ";
    }

    .breadcrumb ul li:last-child::after {
        content: "";
    }

    .breadcrumb ul li.linked {
        font-weight: 800;
    }
</style>
