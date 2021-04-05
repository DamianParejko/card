<template>
  <div class="side">
    <div class="title">Crud App</div>
    <div class="menu-items">
      <router-link to="/" tab="button" class="link-btn">
        <div class="link-container">Card list</div>
      </router-link>

      <router-link :to="{ name: 'add' }" tab="button" class="link-btn">
        <div class="link-container">Create a card</div>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {};
</script>