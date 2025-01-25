panel.plugin("tilmannruppert/uikit-blocks", {
  blocks: {
    card: {
      template: `
          <div class="uicard" style="border: 1px solid black; border-radius: 5px" @click="open">
            <div v-for="item in content.blocks">
              <k-block :type="item.type" :content="item.content" disabled="true"></k-block>
            </div>      
          </div>
        `,
      },
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