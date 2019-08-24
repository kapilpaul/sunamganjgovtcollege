<template>
  <div class="form-group">
    <label>{{ label }}</label>
    <input
      :type="type"
      class="form-control"
      :name="name"
      :placeholder="placeholder"
      :required="required"
      @input="$emit('input', $event.target.value)"
    />
  </div>
</template>

<script>
export default {
  props: {
    label: {
      type: String,
      default: ""
    },
    name: {
      type: String,
      default: ""
    },
    placeholder: {
      type: String,
      default: ""
    },
    value: {
      type: String,
      default: ""
    },
    required: {
      type: Boolean,
      default: false
    },
    type: {
      type: String,
      default: "text"
    }
  },
  data() {
    return {
      inputData: ""
    };
  }
};
</script>

<style lang="scss" scoped>
</style>