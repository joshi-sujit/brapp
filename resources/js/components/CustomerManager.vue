<template>
  <form>
    <a @click="addCustomer" class="add">+ Add Customer</a>
    <div v-for="(customer,index) in customers" :key="customer.id">
      <input type="text" v-model="customer.name" :ref="customer.name">
      <input type="text" v-model="customer.mobile">
      <a @click="removeCustomer(index)" class="remove">delete</a>
    </div>
  </form>
</template>

<script>
export default {
  props: ["initialCustomers"],
  data() {
    return {
      customers: _.cloneDeep(this.initialCustomers)
    };
  },

  created(){
    axios.post('/api/customers/upsert');
  },

  methods: {
    removeCustomer(index) {
      if (confirm("Are you sure?")) {
        this.customers.splice(index, 1);
      }
    },

    addCustomer() {
      this.customers.push({
        id: 0,
        name: "",
        mobile: ""
      });
      this.$nextTick(() => {
        window.scrollTo(0, document.body.scrollHeight);
        this.$refs[""][0].focus();
      });
    }
  }
};
</script>
