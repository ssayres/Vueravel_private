<template>
  <div>
    <i :class="classButton"></i>
    <a :href="link">
      {{ text }}
    </a>
  </div>
</template>

<script lang="ts">
export default {
  name: "InstagramButton",

  props: {
    text: {
      type: String,
      required: false,
      default: "defaultText"
    },
    link: {
      type: String,
      required: true
    },
    classButton: {
      type: String,
      required: true
    }
  }
};
</script>

<style lang="scss" scoped>
a {
  font-size: 16px;
  color: rgb(255, 255, 255);
  font-family: "Merriweather", serif;
}

a:hover {
  text-decoration: none;
  filter: drop-shadow(0 0 4px color("via", "gray"));
}

a:active,
a:visited,
a:link {
  color: whitesmoke;
}

i {
  padding-top: 15px;
  font-size: 26px;
}
</style>
