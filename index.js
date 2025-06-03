panel.plugin("tilmannruppert/uikit-blocks", {
  blocks: {
    overlay: {
      computed: {
        backgroundStyle() {
          if (this.content.hover_image && this.content.image_2 && this.content.image_2.length) {
            return `
              background-image: url('${this.content.image[0]?.url}');
              transition: background-image 0.3s ease;
            `;
          } else if (this.content.image && this.content.image.length) {
            return `background-image: url('${this.content.image[0]?.url}');`;
          }
          return "background: #f0f0f0;"; // fallback
        },
        alignmentStyle() {
          const position = this.content.position || "center";

          // Wenn Position "cover", dann absolut platzieren
          if (position === "cover") {
            return "position: absolute; top: 0; left: 0; right: 0; bottom: 0; padding: 20px;";
          }

          // Fallback-Ausrichtung
          let justify = "flex-start";
          let align = "flex-start";

          // horizontale Ausrichtung basierend auf position
          const map = {
            "top-left": ["flex-start", "flex-start"],
            "top-center": ["center", "flex-start"],
            "top-right": ["flex-end", "flex-start"],
            "center-left": ["flex-start", "center"],
            "center": ["center", "center"],
            "center-right": ["flex-end", "center"],
            "bottom-left": ["flex-start", "flex-end"],
            "bottom-center": ["center", "flex-end"],
            "bottom-right": ["flex-end", "flex-end"],
            "top": ["center", "flex-start"],
            "bottom": ["center", "flex-end"],
          };

          if (map[position]) {
            [justify, align] = map[position];
          }

          // vertikale Ausrichtung über flex_vertical, falls vorhanden
          const vertical = this.content.flex_vertical;
          if (vertical) {
            if (vertical === "uk-flex-middle") align = "center";
            if (vertical === "uk-flex-bottom") align = "flex-end";
            if (vertical === "uk-flex-top") align = "flex-start";
          }

          return `display: flex; justify-content: ${justify}; align-items: ${align};`;
        },
        boxSizeStyle() {
          const widthMap = {
            "uk-width-1-2": "50%",
            "uk-width-1-3": "33.3333%",
            "uk-width-1-4": "25%",
            "uk-width-small": "150px",
            "uk-width-medium": "300px",
            "uk-width-large": "600px",
            "uk-width-xlarge": "900px",
            "uk-width-2xlarge": "1200px",
          };
          const value = widthMap[this.content.width] || "100%";
          return `max-width: ${value}; width: 100%;`;
        },
      },
      methods: {
        onMouseEnter(event) {
          if (this.content.hover_image && this.content.image_2 && this.content.image_2.length) {
            event.currentTarget.style.backgroundImage = `url('${this.content.image_2[0].url}')`;
          }
        },
        onMouseLeave(event) {
          if (this.content.hover_image && this.content.image && this.content.image.length) {
            event.currentTarget.style.backgroundImage = `url('${this.content.image[0].url}')`;
          }
        }
      },
      template: `
        <div
          :style="backgroundStyle + ' background-size: cover; background-position: center; border: 1px dashed black; overflow: hidden; aspect-ratio: ' + (content.ratio || '16/9') + '; position: relative;'"
          @click="open"
          @mouseenter="onMouseEnter"
          @mouseleave="onMouseLeave"
        >
          <div :style="'padding: ' + (content.space === 'uk-position-small' ? '10px' : content.space === 'uk-position-medium' ? '30px' : content.space === 'uk-position-large' ? '50px' : '0') + '; box-sizing: border-box; width: 100%; height: 100%; display: flex;'">
            <div :style="alignmentStyle + ' display: flex; width: 100%; height: 100%;'">
              <div :style="boxSizeStyle + ' background: white; width: 100%; display: flex; flex-direction: column;'">
                <k-block v-for="item in content.blocks" :type="item.type" :content="item.content" :key="item.id" disabled="true"></k-block>
              </div>
            </div>
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
        :placeholder="'Button text …'"
        :value="content.text"
        :class="[content.class]"
        @input="update({ text: $event.target.value })"
        @dblclick="open"
      />
      `
    },
    to_top: {
      template: `
        <button @click="open">
          ↑ Scroll to top
        </button>
      `,
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
        <div class="iconplus" @click="open">
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
    countup: {
      template: `
        <div class="uicountup" @click="open">
        <span>{{ content.number }}</span>
        </div>
      `,
    },
    heading: {
      data() {
        return {
          showToolbar: false
        };
      },
      computed: {
        level() {
          const level = parseInt(this.content.level?.replace("h", ""));
          return isNaN(level) ? 2 : level;
        },
        textField() {
          return this.field("text", {
            marks: true
          });
        },
        levels() {
          return this.field("level", { options: [] }).options;
        },
        alignOptions() {
          return this.field("align", { options: [] }).options;
        },
        keys() {
          return {
            Enter: () => {
              if (this.$refs.input.isCursorAtEnd === true) {
                return this.$emit("append", "text");
              }
              return this.split();
            },
            "Mod-Enter": this.split
          };
        }
      },
      methods: {
        focus() {
          this.$refs.input.focus();
        },
        merge(blocks) {
          this.update({
            text: blocks.map((block) => block.content.text).join(" ")
          });
        },
        split() {
          const contents = this.$refs.input.getSplitContent?.();
          if (contents) {
            this.$emit("split", [
              { text: contents[0] },
              {
                level: "h" + Math.min(parseInt(this.content.level?.replace("h", "")) + 1, 6),
                text: contents[1]
              }
            ]);
          }
        }
      },
      template: `
        <div class="block-wrapper" style="position: relative;" @mouseenter="showToolbar = true" @mouseleave="showToolbar = false">
          <div
            :data-level="content.level"
            class="k-block-type-heading-input"
            :style="{
              textAlign:
                content.align === 'uk-text-left' ? 'left' :
                content.align === 'uk-text-center@m' ? 'center' :
                content.align === 'uk-text-right@m' ? 'right' : 'left'
            }"
          >
            <k-writer
              ref="input"
              v-bind="textField"
              :disabled="disabled"
              :inline="true"
              :keys="keys"
              :value="content.text"
              @input="update({ text: $event })"
            />
            
            <div v-if="!disabled" class="block-toolbar" :style="{ position: 'absolute', top: '4px', right: '4px', display: showToolbar ? 'flex' : 'none', gap: '4px' }">
              <k-input
                ref="level"
                :disabled="disabled"
                :empty="false"
                :options="levels"
                :value="content.level"
                type="select"
                style="max-width: 80px;"
                @input="update({ level: $event })"
              />
              <k-button
                icon="text-left"
                :variant="content.align === 'uk-text-left' ? 'filled' : 'outlined'"
                @click="update({ align: 'uk-text-left' })"
              />
              <k-button
                icon="text-center"
                :variant="content.align === 'uk-text-center@m' ? 'filled' : 'outlined'"
                @click="update({ align: 'uk-text-center@m' })"
              />
              <k-button
                icon="text-right"
                :variant="content.align === 'uk-text-right@m' ? 'filled' : 'outlined'"
                @click="update({ align: 'uk-text-right@m' })"
              />
            </div>
          </div>
        </div>
      `
    },
    text: {
      data() {
        return {
          showToolbar: false
        };
      },
      computed: {
        textField() {
          return this.field("text", {
            marks: true
          });
        },
        alignOptions() {
          return this.field("align", { options: [] }).options;
        },
        keys() {
          return {
            Enter: () => {
              if (this.$refs.input.isCursorAtEnd === true) {
                return this.$emit("append", "text");
              }
              return this.split();
            },
            "Mod-Enter": this.split
          };
        }
      },
      methods: {
        focus() {
          this.$refs.input.focus();
        },
        merge(blocks) {
          this.update({
            text: blocks.map((block) => block.content.text).join(" ")
          });
        },
        split() {
          const contents = this.$refs.input.getSplitContent?.();
          if (contents) {
            this.$emit("split", [
              { text: contents[0] },
              { text: contents[1] }
            ]);
          }
        }
      },
      template: `
        <div class="block-wrapper" style="padding:10px; position: relative;" @mouseenter="showToolbar = true" @mouseleave="showToolbar = false">
          <div
            class="k-block-type-text-input"
            :style="{
              textAlign:
                content.align === 'uk-text-left' ? 'left' :
                content.align === 'uk-text-center@m' ? 'center' :
                content.align === 'uk-text-right@m' ? 'right' : 'left'
            }"
          >
            <div style="display: flex; align-items: flex-start; gap: 8px;">
              <k-writer
                ref="input"
                v-bind="textField"
                :disabled="disabled"
                :inline="true"
                :keys="keys"
                :value="content.text"
                style="flex: 1;"
                @input="update({ text: $event })"
              />

              <div v-if="!disabled" class="block-toolbar" :style="{ position: 'absolute', top: '4px', right: '4px', display: showToolbar ? 'flex' : 'none', gap: '4px' }">
                <k-button
                  icon="text-left"
                  :variant="content.align === 'uk-text-left' ? 'filled' : 'outlined'"
                  @click="update({ align: 'uk-text-left' })"
                />
                <k-button
                  icon="text-center"
                  :variant="content.align === 'uk-text-center@m' ? 'filled' : 'outlined'"
                  @click="update({ align: 'uk-text-center@m' })"
                />
                <k-button
                  icon="text-right"
                  :variant="content.align === 'uk-text-right@m' ? 'filled' : 'outlined'"
                  @click="update({ align: 'uk-text-right@m' })"
                />
              </div>
            </div>
          </div>
        </div>
      `
    },
    subnavigation: {
      computed: {
          title() {
              // Manuell gesetzter Titel
              if (this.content.title) return this.content.title;
    
              // Seiten (pages) auswerten
              try {
                const page = this.content.pages ? this.content.pages[0] : null;
                if (page) {
                  return page.text || "Kein Titel";
                }
              } catch (e) {
                return "Kein Titel";
              }
    
              return "Kein Titel"; // Fallback
            },
          },
          template: `
             <div @click="open">
              <span>{{ title }}</span>
            </div>
          `
    },
    panel: {
      computed: {
        backgroundStyle() {
          let styles = [];

          if (this.content.image && this.content.image.length) {
            styles.push(`background-image: url('${this.content.image[0]?.url}')`);
            styles.push("background-size: cover");
            styles.push("background-position: center");
          }

          if (this.content.image_minheight) {
            styles.push(`min-height: ${this.content.image_minheight}px`);
          }

          return styles.join("; ") + ";";
        },
        alignmentStyle() {
          const align = this.content.flex_vertical || "uk-flex-top";
          const justify = this.content.flex_horizontal || "uk-flex-left";

          const alignMap = {
            "uk-flex-top": "flex-start",
            "uk-flex-middle": "center",
            "uk-flex-bottom": "flex-end",
          };
          const justifyMap = {
            "uk-flex-left": "flex-start",
            "uk-flex-center": "center",
            "uk-flex-right": "flex-end",
          };

          return `display: flex; justify-content: ${justifyMap[justify]}; align-items: ${alignMap[align]}; width: 100%; height: 100%;`;
        },
        contentPadding() {
          const map = {
            "uk-position-small": "10px",
            "uk-position-medium": "30px",
            "uk-position-large": "50px",
          };
          return map[this.content.space] || "0";
        },
        classNames() {
          const classes = [];

          if (this.content.background) {
            classes.push(this.content.background);
          }

          if (this.content.color) {
            classes.push(this.content.color);
          }

          if (this.content.padding) {
            classes.push(this.content.padding);
          }

          if (this.content.class) {
            classes.push(this.content.class);
          }

          return classes.join(" ");
        },
      },
      template: `
        <div
          :style="backgroundStyle + ' position: relative; overflow: hidden; aspect-ratio: ' + (content.ratio || '16/9') + '; border: 1px dashed black;'"
          :class="classNames"
          @click="open"
        >
          <div :style="'padding: ' + contentPadding + '; box-sizing: border-box; width: 100%; height: 100%; display: flex;'">
            <div :style="alignmentStyle">
              <div style="background: white; width: 100%; display: flex; flex-direction: column;">
                <k-block v-for="item in content.blocks" :type="item.type" :content="item.content" :key="item.id" disabled="true" />
              </div>
            </div>
          </div>
        </div>
      `,
    },
    grid: {
      setup(props) {
          const { computed } = window.Vue;

          // columns reaktiv aus layout
          const columns = computed(() => {
          const layout = props.content.layout || "";
          const match = layout.match(/uk-child-width-1-(\d)/);
          if (match && match[1]) {
              return Number(match[1]);
          }
          return 2;
          });

          // items = Array der Inhalte aus content.content (Blocks)
          const items = computed(() => {
          // Falls content.content ein Array von Blöcken ist, nutze deren Inhalt oder Typ als Platzhalter
          if (Array.isArray(props.content.content)) {
              return props.content.content.map(block => block.type || "Block");
          }
          return [];
          });

          return { columns, items };
        },
  
        template: `
          <k-grid :style="'gap: 0.25rem; --columns: ' + columns" @click="open">
          <k-box
              theme="passive"
              v-for="(item, index) in items"
              :key="index"
              style="text-align: center;"
          >
              {{ item }}
          </k-box>
          </k-grid>
        `
    },
    },
    }
);