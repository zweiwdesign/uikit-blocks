panel.plugin("tilmannruppert/uikit-blocks", {
    blocks: {
      button: {
        computed: {
          placeholder() {
            return "Button text …";
          }
        },
        template: `
          <input
            type="text"
            :placeholder="placeholder"
            :value="content.text"
            :class="[content.class]"
            @input="update({ text: $event.target.value })"
            @dblclick="open"
          />
        `
        }
    }
  });