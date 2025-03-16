panel.plugin("tilmannruppert/uikit-blocks", {
  blocks: {
    overlay: {
      template: `
          <div class="" style="border: 1px dashed black; border-radius: 5px" @click="open">
            <div v-for="item in content.blocks">
              <k-block :type="item.type" :content="item.content" disabled="true"></k-block>
            </div>      
          </div>
        `,
      },
    card: {
      template: `
          <div class="uicard" style="border: 1px solid black; border-radius: 5px" @click="open">
            <div v-for="item in content.blocks">
              <k-block :type="item.type" :content="item.content" disabled="true"></k-block>
            </div>      
          </div>
        `,
    },
    buttons: {
      template: `
        <div class="" @click="open">
          <div v-for="item in content.blocks">
            <k-block :type="item.type" :content="item.content"></k-block>
          </div>      
        </div>
      `
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
    },
    iconflex: {
      computed: {
        frameWidth() {
          return this.content && this.content.iconsize
            ? `${this.content.iconsize * 20}px`
            : "40px";
          },
        iconSize() {
          return this.content && this.content.iconsize ? this.content.iconsize : 2;
        },
      },
      mounted() {
        // Stellen sicher, dass das Icon nach der ersten Anzeige korrekt geladen wird
        this.$nextTick(() => {
          if (this.$refs.iconElement) {
            UIkit.icon(this.$refs.iconElement); // UIkit zwingt Icons zur Anzeige
          }
        });
      },
      template: `
        <div class="iconplus" @dblclick="open">
          <div style="padding-top: 13px; padding-left: 10px">  
            <k-frame
              :cover="true"
              :ratio="1/1"
              :style="{ width: frameWidth, height: frameWidth }"
            >
              <!-- Icon anzeigen, falls vorhanden -->
              <span v-if="content.icon"
                  :data-uk-icon="'icon: ' + content.icon + '; ratio: ' + iconSize"
                  ref="iconElement"
                  :style="{ width: frameWidth, height: frameWidth, display: 'inline-block' }">
              </span>
                    
              <!-- Bild anzeigen, falls kein Icon vorhanden ist -->
              <img v-else-if="content.bild && content.bild.length"
                  :src="content.bild[0].url"
                  alt=""
              >
            </k-frame>
          </div>

          <div>
            <div v-for="item in content.blocks">
              <k-block :type="item.type" :content="item.content" disabled="true"></k-block>
            </div>
          </div>     
        </div>
        `,
    },        
    divider: {
      template: `
        <hr style="border: none; border-top: 1px solid #ccc; margin: 10px 0;">
        `,
    },
    accordion: {
      template: `
        <div class="" @click="open">
          <div v-for="item in content.blocks">
            <k-block :type="item.type" :content="item.content" disabled="true"></k-block>
          </div>      
        </div>
      `,
    },
    inner_accordion: {
      template: `
        <div class="" style="border-bottom: 1px solid black;" @click="open">
          <k-text>
          <h3>
            {{ content.headline }}
          </h3></k-text>
          <div v-for="item in content.blocks">
            <k-block :type="item.type" :content="item.content" disabled="true"></k-block>
          </div>      
        </div>
        `,
    },
    tab: {
      template: `
        <div class="uitab" style="border-bottom: 1px solid black;" @click="open">
          <ul class="ui-tab">
            <li v-for="(tab, index) in content.tabs" :key="index" @click="activeTab = index">
              {{ tab.headline }}
            </li>
          </ul>
        </div>
      `,
    },
    },
    }
);