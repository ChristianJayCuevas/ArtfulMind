<template>
    <div id="draw">
      <div class="app-wrapper">
        <div class="canvas-container">
            <canvas id="canvas"></canvas>
            <div class="cursor" id="cursor"></div>

            <div class="controls">
            <div class="btn-row">
                <div class="history" title="history"></div>
            </div>
            <div class="btn-row">
                <button type="button"
                        v-on:click="removeHistoryItem"
                        v-bind:class="{ disabled: !history.length }" title="Undo">
                <i class="ion ion-reply"></i>
                </button>
                <button type="button"
                        v-on:click="removeAllHistory"
                        v-bind:class="{ disabled: !history.length }" title="Clear all">
                <i class="ion ion-trash-a"></i>
                </button>
            </div>

            <div class="btn-row">
                <button title="Brush options"
                        v-on:click="popups.showOptions = !popups.showOptions">
                <i class="ion ion-android-create"></i>
                </button>

                <div class="popup" v-if="popups.showOptions">
                <div class="popup-title">
                    Options
                </div>
                <button title="Restrict movement vertical"
                        v-on:click="options.restrictY = !options.restrictY; options.restrictX = false"
                        v-bind:class="{ active: options.restrictY }">
                    <i class="ion ion-arrow-right-c"></i>
                    Restrict vertical
                </button>
                <button title="Restrict movement horizontal"
                        v-on:click="options.restrictX = !options.restrictX; options.restrictY = false"
                        v-bind:class="{ active: options.restrictX }">
                    <i class="ion ion-arrow-up-c"></i>
                    Restrict horizontal
                </button>
                <button type="button"
                        v-on:click="simplify"
                        v-bind:class="{ disabled: !history.length }" title="Simplify paths">
                    <i class="ion ion-wand"></i>
                    Simplify paths
                </button>
                <button type="button"
                        v-on:click="jumble"
                        v-bind:class="{ disabled: !history.length }" title="Go nutz">
                    <i class="ion ion-shuffle"></i>
                    Go nutz
                </button>
                </div>
            </div>

            <div class="btn-row">
                <button title="Pick a brush size"
                        v-on:click="popups.showSize = !popups.showSize"
                        v-bind:class="{ active: popups.showSize }">
                <i class="ion ion-android-radio-button-on"></i>
                <span class="size-icon">
                    {{ size }}
                </span>
                </button>

                <div class="popup" v-if="popups.showSize">
                <div class="popup-title">
                    Brush size
                </div>
                <label v-for="sizeItem in sizes" class="size-item">
                    <input type="radio" name="size" v-model="size" v-bind:value="sizeItem">
                    <span class="size"
                        v-bind:style="{width: sizeItem + 'px', height: sizeItem + 'px'}"
                        v-on:click="popups.showSize = !popups.showSize"></span>
                </label>
                </div>
            </div>

            <div class="btn-row">
                <button title="Pick a color"
                        v-on:click="popups.showColor = !popups.showColor"
                        v-bind:class="{ active: popups.showColor }">
                <i class="ion ion-android-color-palette"></i>
                <span class="color-icon"
                        v-bind:style="{backgroundColor: color}">
                </span>
                </button>

                <div class="popup" v-if="popups.showColor">
                <div class="popup-title">
                    Brush color
                </div>
                <label v-for="colorItem in colors" class="color-item">
                    <input type="radio"
                        name="color"
                        v-model="color"
                        v-bind:value="colorItem">
                    <span v-bind:class="'color color-' + colorItem"
                        v-bind:style="{backgroundColor: colorItem}"
                        v-on:click="popups.showColor = !popups.showColor"></span>
                </label>
                </div>
            </div>

            <div class="btn-row">
        <!-- Save button -->
        <button title="Save" @click="popups.showSave = !popups.showSave">
            <i class="ion ion-android-cloud-outline"></i>
        </button>

        <!-- Save popup -->
        <div class="popup" v-if="popups.showSave">
            <div class="popup-title">
            Save your designs
            </div>
            <div class="form">
            <input type="text" placeholder="Save name" v-model="save.name">
            <div v-if="save.name.length < 3" class="text-faded">
                <i>Min 3 characters</i>
            </div>
            <span class="btn background-color: #0095ff" @click="saveDrawing" :disabled="history.length === 0">
                Save as <span class="text-faded">{{ save.name }}</span>
            </span>
            </div>
        </div>

        <button title="Load" @click="popups.showLoad = !popups.showLoad">
                <i class="ion ion-android-cloud-outline"></i>
        </button>

        <!-- Load popup -->
        <div class="popup" v-if="popups.showLoad">
                <div class="popup-title">Load Drawing</div>
                <div v-if="save.saveItems.length === 0">No saved drawings</div>
                <div v-else>
                    <button v-for="item in save.saveItems" :key="item.id" @click="loadDrawing(item.id)">
                    {{ item.name }}
                    </button>
                </div>
                <button @click="popups.showLoad = false">Close</button>
        </div>
        </div>

            </div>
        </div>
        </div>
    </div>
  </template>
  <script>

  import { ref, onMounted } from 'vue';
  import axios from 'axios';

  export default {

    data() {
      return {

        history: ref([]),
        save: ref({ name: '', saveItems: [] }),
        color: '#13c5f7',
        popups: {
          showColor: false,
          showSize: false,
          showWelcome: true,
          showSave: false,
          showOptions: false,
        },
        options: {
          restrictY: false,
          restrictX: false,
        },
        size: 12,
        colors: [
          '#d4f713',
          '#13f7ab',
          '#13f3f7',
          '#13c5f7',
          '#138cf7',
          '#1353f7',
          '#2d13f7',
          '#7513f7',
          '#a713f7',
          '#d413f7',
          '#f713e0',
          '#f71397',
          '#f7135b',
          '#f71313',
          '#f76213',
          '#f79413',
          '#f7e013',
        ],
        sizes: [6, 12, 24, 48],
        weights: [2, 4, 6],
      };
    },
    methods: {
      async loadSavedItems() {
        try {
          const response = await axios.get('/load-saved-items');
          this.save.saveItems = response.data;
        } catch (error) {
          console.error('Error loading initial save items:', error);
        }
      },
      async saveDrawing() {
        // Check the name and drawingData values before sending the request
        console.log("Name:", this.save.name);
        console.log("Drawing Data:", this.history);

        if (this.save.name.length < 3) {
          alert('Save name must be at least 3 characters long');
          return;
        }


        try {
          const response = await axios.post('/save-drawing', {
            name: this.save.name,
            drawingData: JSON.stringify(this.history),
          });

          // Log the response from the server
          console.log("Response:", response.data);

          alert('Drawing saved successfully!');
          this.save.saveItems.push(response.data);
          this.save.name = '';
        } catch (error) {
          console.error('Error saving drawing:', error);
          alert('Error saving drawing, check console for details');
        }
      },
      async onMounted() {
        await this.loadSavedItems();
      },
      async loadDrawing(id) {
    try {
      const response = await axios.get(`/load-drawing/${id}`);
      console.log("Response:", response.data); // Log the response data
      const drawingData = response.data;
      console.log("Loading drawing data:", drawingData); // Debugging statement
      if (drawingData) {
        this.history = drawingData;
        this.redraw();
      } else {
        console.error('Error loading drawing: drawingData is undefined');
      }
    } catch (error) {
      console.error('Error loading drawing:', error);
    }
  },
      removeHistoryItem() {
        this.history.splice(this.history.length - 2, 1);
        this.redraw();
      },
      removeAllHistory() {
        this.history = [];
        this.redraw();
      },
      simplify() {
        var simpleHistory = [];
        this.history.forEach((item, i) => {
          if (i % 6 !== 1 || item.isDummy) {
            simpleHistory.push(item);
          }
        });
        this.history = simpleHistory;
        this.redraw();
      },
      jumble() {
        var simpleHistory = [];
        this.history.forEach((item, i) => {
          item.r += Math.sin(i * 20) * 5;
        });
        this.history = this.shuffle(this.history);
        this.redraw();
      },
      shuffle(a) {
        var b = [];

        a.forEach((item, i) => {
          if (!item.isDummy) {
            var l = b.length;
            var r = Math.floor(l * Math.random());
            b.splice(r, 0, item);
          }
        });

        for (var i = 0; i < b.length; i++) {
          if (i % 20 === 1) {
            b.push(this.getDummyItem());
          }
        }

        return b;
      },
      saveItem() {
        if (save.value.name.length > 2) {

          var historyItem = {
            history: this.history.slice(),
            name: this.save.value.name,
          };

          this.save.value.saveItems.push(historyItem);
          this.save.value.name = '';
        }
      },
      setDummyPoint() {
        var item = this.getDummyItem();
        this.history.push(item);
        this.draw(item, this.history.length);
      },
      redraw() {
        this.ctx.clearRect(0, 0, this.c.width, this.c.height);
        this.drawBgDots();

        if (!this.history.length) {
          return true;
        }

        this.history.forEach((item, i) => {
          this.draw(item, i);
        });
      },
      drawBgDots() {
        var gridSize = 50;
        this.ctx.fillStyle = 'rgba(0, 0, 0, .2)';

        for (var i = 0; i * gridSize < this.c.width; i++) {
          for (var j = 0; j * gridSize < this.c.height; j++) {
            if (i > 0 && j > 0) {
              this.ctx.beginPath();
              this.ctx.rect(i * gridSize, j * gridSize, 2, 2);
              this.ctx.fill();
              this.ctx.closePath();
            }
          }
        }
      },
      draw(item, i) {
        this.ctx.lineCap = 'round';
        this.ctx.lineJoin = 'round';

        var prevItem = this.history[i - 2];

        if (i < 2) {
          return false;
        }

        if (!item.isDummy && !this.history[i - 1].isDummy && !prevItem.isDummy) {
          this.ctx.strokeStyle = item.c;
          this.ctx.lineWidth = item.r;

          this.ctx.beginPath();
          this.ctx.moveTo(prevItem.x, prevItem.y);
          this.ctx.lineTo(item.x, item.y);
          this.ctx.stroke();
          this.ctx.closePath();
        } else if (!item.isDummy) {
          this.ctx.strokeStyle = item.c;
          this.ctx.lineWidth = item.r;

          this.ctx.beginPath();
          this.ctx.moveTo(item.x, item.y);
          this.ctx.lineTo(item.x, item.y);
          this.ctx.stroke();
          this.ctx.closePath();
        }
      },
      getDummyItem() {
      if (this.history.length > 0) {
        var lastPoint = this.history[this.history.length - 1];

        return {
          isDummy: true,
          x: lastPoint.x,
          y: lastPoint.y,
          c: null,
          r: null,
        };
      } else {
        // If history is empty, return a default dummy item
        return {
          isDummy: true,
          x: 0,
          y: 0,
          c: null,
          r: null,
        };
      }
    },
      setSize() {
        this.c.width = window.innerWidth;
        this.c.height = window.innerHeight - 60;
      },
      moveMouse(e) {
      let x = e.offsetX;
      let y = e.offsetY;
      // Calculate the canvas position within the layout
      let canvasRect = this.c.getBoundingClientRect();
      let offsetX = canvasRect.left;
      let offsetY = canvasRect.top;

      // Update the cursor position using the canvas position
      var cursor = document.getElementById('cursor');
      cursor.style.transform = `translate(${x - 10 + offsetX}px, ${y - 10 + offsetY}px)`;
      }
    },
    mounted() {
      this.loadSavedItems();
      this.c = document.getElementById('canvas');
      this.ctx = this.c.getContext('2d');

      this.mouseDown = false;
      this.mouseX = 0;
      this.mouseY = 0;

      this.tempHistory = [];

      this.setSize();
      this.redraw();

      this.c.addEventListener('mousedown', (e) => {
        this.mouseDown = true;
        this.mouseX = e.offsetX;
        this.mouseY = e.offsetY;
        this.setDummyPoint();
      });

      this.c.addEventListener('mouseup', () => {
        if (this.mouseDown) {
          this.setDummyPoint();
        }
        this.mouseDown = false;
      });

      this.c.addEventListener('mouseleave', () => {
        if (this.mouseDown) {
          this.setDummyPoint();
        }
        this.mouseDown = false;
      });

      this.c.addEventListener('mousemove', (e) => {
        this.moveMouse(e);
        if (this.mouseDown) {
          this.mouseX = this.mouseX;
          this.mouseY = this.mouseY;

          if (!this.options.restrictX) {
            this.mouseX = e.offsetX;
          }

          if (!this.options.restrictY) {
            this.mouseY = e.offsetY;
          }

          var item = {
            isDummy: false,
            x: this.mouseX,
            y: this.mouseY,
            c: this.color,
            r: this.size,
          };

          this.history.push(item);
          this.draw(item, this.history.length);
        }
      });

      window.addEventListener('resize', () => {
        this.setSize();
        this.redraw();
      });

    },
  };
  </script>

  <style scoped>
  /* Include your CSS code here, with necessary adjustments */
  @import url('https://fonts.googleapis.com/css?family=Roboto:300,400,500');
  @import url('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');

  .btn {
    @apply inline-block mt-10 px-20 py-10 text-base font-normal rounded bg-blue-500 text-black cursor-pointer;
    animation-delay: 1s;
    transition: all 0.15s;
  }

  .btn:hover {
    @apply bg-blue-600;
  }
  </style>
