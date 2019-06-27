<template>
  <form @submit.prevent="saveCustomer">
    <a @click="addCustomer" class="add">+ Add Customer</a>
    <div v-for="(customer,index) in customers" :key="customer.id">
      <input type="text" v-model="customer.name" :ref="customer.name">
      <input type="text" v-model="customer.email" :ref="customer.email">
      <input type="text" v-model="customer.mobile">
      <a @click="removeCustomer(index)" class="remove">delete</a>
    </div>
    <button type="submit">Save</button>
    <div>{{ feedback }}</div>
  </form>
</template>

<script>
export default {
  props: ["initialCustomers"],
  data() {
    return {
      customers: _.cloneDeep(this.initialCustomers),
      feedback: ""
    };
  },

  created() {
    axios.post("/api/customers/upsert");
  },

  methods: {
    removeCustomer(index) {
      if (confirm("Are you sure?")) {
        let id = this.customers[index].id;
        if (id > 0) {
          axios.delete("/api/customers/" + id);
        }
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
    },

    saveCustomer() {
      axios
        .post("/api/customers/upsert", {
          customers: this.customers
        })
        .then(res => {
          if (res.data.success) {
            this.feedback = "Changed";
            this.customers = res.customers;
          }
        });
    }
  }
};
</script>
