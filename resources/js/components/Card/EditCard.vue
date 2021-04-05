<template>
  <div class="dashboard">
    <Navbar />
    <div class="content">
      <div class="container">
        <div class="addlist">
          <form @submit.prevent="updateCard()">
            <div class="row">
              <div class="form-group col-10">
                <label for="number">Card number</label>
                <input
                  type="text"
                  class="form-control"
                  name="number"
                  v-model="card.number"
                />
                <div v-if="errors && errors.number" class="text-danger">
                  {{ errors.number[0] }}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-5">
                <label for="pin">PIN</label>
                <input
                  type="text"
                  class="form-control"
                  name="pin"
                  v-model="card.pin"
                />
                <div v-if="errors && errors.pin" class="text-danger">
                  {{ errors.pin[0] }}
                </div>
              </div>

              <div class="form-group col-5">
                <label for="balance">Cash</label>
                <input
                  type="text"
                  class="form-control"
                  name="balance"
                  v-model="card.balance"
                />
                <div v-if="errors && errors.balance" class="text-danger">
                  {{ errors.balance[0] }}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-5">
                <label for="activation">Activation</label>
                <datetime
                  v-model="activation"
                  type="datetime"
                  name="activation"
                >
                </datetime>

                <div v-if="errors && errors.activation" class="text-danger">
                  {{ errors.activation[0] }}
                </div>
              </div>

              <div class="form-group col-5">
                <label for="validity">Validity</label>
                <datetime v-model="card.validity" type="date" name="validity">
                </datetime>
                <div v-if="errors && errors.validity" class="text-danger">
                  {{ errors.validity[0] }}
                </div>
              </div>

              <div class="form-group col-12">
                <br />
                <button type="submit" class="btn btn-secondary btn-block col-4">
                  Update
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <FlashMessage />
  </div>
</template>

<script>
import Navbar from "../Nav/Navbar.vue";

export default {
  components: { Navbar },

  data() {
    return {
      card: {},
      errors: {},
      activation: "",
      validity: "",
    };
  },

  created() {
    axios.get(`/api/card/edit/${this.$route.params.id}`).then((res) => {
      this.card = res.data;
      this.activation = res.data.activation.replace(" ", "T");
    });
  },

  methods: {
    updateCard() {
      axios
        .patch(`/api/card/${this.$route.params.id}`, {
          number: this.card.number,
          pin: this.card.pin,
          balance: this.card.balance,
          activation: this.activation.replace("T", " ").replace(".000Z", ""),
          validity: this.card.validity.split("T")[0],
        })
        .then((res) => {
          (this.errors = {}),
            this.flashMessage.success({
              message: "The card has been successfully edited",
              time: 3000,
            });
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = {};
            this.errors = error.response.data.errors;
          }
        });
    },
  },
};
</script>