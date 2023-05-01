<template>
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li v-for="(breadcrumb, index) in breadcrumbs" :key="index">
                <div v-if="index === 0">
                    <a class="bread-main">{{breadcrumb.label}}</a>
                </div>
                <div v-else>
                    <span v-if="index < breadcrumbs.length" class="breadcrumb-divider text-gray-300 pr-2">/</span>
                    <inertia-link :href="breadcrumb.url" >{{ breadcrumb.label }}</inertia-link>
                </div>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        breadcrumbs: {
            type: Array,
            required: true
        }
    }
}
</script>

<style scoped>
.breadcrumb {
    margin-bottom: 1rem;
}

.breadcrumb ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.breadcrumb ul li {
    display: inline-block;
    margin-right: 0.5rem;
}
.breadcrumb ul li p {
    padding: 0;
    margin: 0;
}
.breadcrumb ul li a {
    color: #303133;
    text-decoration: none;
}
.breadcrumb ul li a,p:first-child {
    color: #909399;
    text-decoration: none;
}
.breadcrumb ul li:last-child {
    margin-right: 0;
}

/*.breadcrumb ul li::after {*/
/*    content: "/";*/
/*    margin-left: 0.5rem;*/
/*    color: #999;*/
/*}*/

/*.breadcrumb ul li:last-child::after {*/
/*    content: "";*/
/*}*/
</style>