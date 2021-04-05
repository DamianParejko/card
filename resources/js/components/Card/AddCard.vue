<template>
  <div class="dashboard">
    <Navbar />
    <div class="content">
      <div class="container">
        <div class="addlist">
          <form @submit.prevent="createCard">
            <div class="row">
              <div class="form-group col-4">
                <label for="number">Random card number</label>
                <br />
                <toggle-button
                  id="toggle-button"
                  v-model="generator"
                  :sync="true"
                  :labels="{ unchecked: 'No', checked: 'Yes' }"
                  :font-size="15"
                  :width="85"
                  :height="34"
                />
              </div>

              <div class="form-group col-6">
                <label for="number">Card number</label>
                <input
                  type="number"
                  class="form-control"
                  name="number"
                  v-model="number"
                  placeholder="Write the card number"
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
                  type="number"
                  class="form-control"
                  name="pin"
                  v-model="pin"
                  placeholder="XXXX"
                />
                <div v-if="errors && errors.pin" class="text-danger">
                  {{ errors.pin[0] }}
                </div>
              </div>

              <div class="form-group col-5">
                <label for="balance">Cash</label>
                <input
                  type="number"
                  class="form-control"
                  name="balance"
                  v-model="balance"
                  placeholder="Write the card amount "
                />
                <div v-if="errors && errors.balance" class="text-danger">
                  {{ errors.balance[0] }}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-5">
                <label for="activation">Card activation date</label>
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
                <label for="validity">Card validity date</label>
                <datetime v-model="validity" type="date" name="validity">
                </datetime>
                <div v-if="errors && errors.validity" class="text-danger">
                  {{ errors.validity[0] }}
                </div>
              </div>

              <div class="form-group col-12">
                <br />
                <button
                  type="submit"
                  @click.prevent="createCard"
                  class="btn btn-secondary btn-block col-4"
                >
                  Create
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
      errors: {},
      number: "",
      pin: "",
      balance: "",
      activation: "",
      validity: "",
      generator: false,
    };
  },

  watch: {
    generator: function () {
      this.generator ? this.select() : (this.number = "");
    },
  },

  methods: {
    generateNumber() {
      let setOfNumbers = "";
      let chars = "0123456789";
      for (let i = 0; i < 20; i++) {
        setOfNumbers += chars.charAt(Math.floor(Math.random() * chars.length));
      }
      return setOfNumbers;
    },

    select() {
      this.number = this.generateNumber();
    },

    createCard() {
      axios
        .post("/api/card", {
          number: this.number,
          pin: this.pin,
          balance: this.balance,
          activation: this.activation.replace("T", " ").replace(".000Z", ""),
          validity: this.validity.split("T")[0],
        })
        .then((res) => {
          (this.number = ""),
          (this.pin = ""),
          (this.balance = ""),
          (this.activation = ""),
          (this.validity = ""),
          (this.generator = false),
          (this.errors = {}),
          this.flashMessage.success({
              message: "The card has been added successfully",
              time: 3000,
          });
        })
        .catch((error) => {
          if (error.response.status) {
            this.errors = {};
            this.errors = error.response.data.errors;
          }
        });
    },
  },
};
</script>

