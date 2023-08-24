<template>
    <Navbar></Navbar>
    <slot></slot>
</template>

<script setup>
import Navbar
 from '../Components/Navbar.vue';
 import {watchEffect, ref} from 'vue';
import axios from 'axios';

 


</script>

<style lang="scss" scoped>

</style>