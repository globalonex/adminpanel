<template>

    <Header/>

    <div class="container mx-auto">
        <slot/>
    </div>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3'
import Header from './Header.vue'
import axios from 'axios';
export default {
    components: {
        Link,
        Header
    },
};
</script>
