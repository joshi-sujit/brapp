<template>
  <div>
    <div v-for="customer in customers" :key="customer.id">{{ customer.name }}</div>
  </div>
</template>

<script>
export default {
  props: ["customers"]
};
</script>
