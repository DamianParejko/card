<template>
  <div class="dashboard">
    <Navbar />
    <div class="content">
      <div class="cardlist">
        <div
          class="card bg-light mb-3"
          v-for="card in cards.data"
          :key="card.id"
        >
          <div class="card-header">
            Number card: {{ card.number }}
            <button
              class="btn btn-outline-dark btn-sm float-right"
              style="margin-left: 5px"
              @click.prevent="deleteCard(card.id)"
            >
              Delete
            </button>
            <router-link
              :to="{ name: 'edit', params: { id: card.id } }"
              class="btn btn-outline-dark btn-sm float-right"
              >Edit
            </router-link>
          </div>
          <div class="card-body">
            <div class="row justify-content-between">
              <h5 class="card-title" style="margin-left: 30px">
                Cash: {{ card.balance }}
              </h5>
              <p style="margin-right: 30px">PIN: {{ card.pin }}</p>
            </div>

            <div class="row justify-content-between">
              <div class="card text" style="margin-left: 30px">
                <p class="card-text">Activation date: {{ card.activation | shortDate }}</p>
              </div>
              <div class="card text" style="margin-right: 30px">
                <p class="card-text">Card validity: {{ card.validity }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="paginationlist">
        <pagination
          :data="cards"
          @pagination-change-page="getCards"
          :limit='2'
        > 
          <span slot="prev-nav">&lt; Previous</span>
          <span slot="next-nav">Next &gt;</span>
        </pagination>
      </div>
    </div>
    <FlashMessage />
  </div>
</template>

<script>
import Navbar from "../Nav/Navbar.vue";

export default {
  components: { Navbar },

  mounted() {
    this.getCards();
  },

  data() {
    return {
      cards: {},
    };
  },

  methods: {
    
    getCards(page = 1) {
      axios.get("/api/card?page=" + page).then((res) => {
        this.cards = res.data;
      });
    },
    deleteCard(id) {
      axios.delete(`api/card/${id}`).then((res) => {
        this.getCards();
        this.flashMessage.success({
          message: "The card has been successfully removed",
          time: 3000,
        });
      });
    },
  },
};
</script>