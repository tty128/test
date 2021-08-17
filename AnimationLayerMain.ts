/* eslint-disable no-dupe-class-members */
import Config from '../Config'
import EventParams from './interface/EventParams'
import MainAddOption from './interface/MainAddOption'
import Manager from './Manager'
import DrawObject from './object/DrawObject'

interface Layer {
  id: number,
  manager: Manager
}

export default abstract class AnimationMain {
  private layerConflict : boolean = Config.MAIN_MANAGER_LAYER_CONFLICT_REPLACE
  private canvas : HTMLCanvasElement
  private ctx : CanvasRenderingContext2D | null = null
  private layers : Array<Layer> = []
  private focusLayer : Layer
  protected abstract randomColor: Array<string> | null

  constructor (canvas : HTMLCanvasElement) {
    this.canvas = canvas
    this.ctx = this.canvas.getContext('2d')
    const newLayer = {
      id: 0,
      manager: new Manager()
    }
    this.layers.push(newLayer)
    this.focusLayer = newLayer
  }

  public abstract clickEvent (params : EventParams) : void

  public abstract moveEvent (params : EventParams) : void

  public abstract paint (ctx : CanvasRenderingContext2D) : void

  protected addLayer () : void
  protected addLayer (manager : Manager) : void
  protected addLayer (index : number) : void
  protected addLayer (manager : Manager, index : number) : void
  protected addLayer (manager : Manager, index : number, replace : boolean) : void
  protected addLayer (value? : Manager | number, index? : number, replace? : boolean) : void {
    const rep : boolean = replace || this.layerConflict
    const addLayer : Layer = {
      id: typeof value === 'number' ? value : (index || this.layers[this.layers.length - 1].id + 1),
      manager: value instanceof Manager ? value : new Manager()
    }

    const layers : Array<Layer> = []

    if (index) {
      let counter = 0
      let prevId = 0
      this.layers.forEach((layer: Layer) => {
        if (prevId < addLayer.id && addLayer.id <= layer.id) {
          layers.push(addLayer)
          counter++
        }
        if (layer.id !== addLayer.id || !rep) {
          layers.push({
            id: layer.id + (rep ? 0 : counter),
            manager: layer.manager
          })
        }
        prevId = layer.id
      })
      this.layers = layers
    } else {
      this.layers.push(addLayer)
    }

    this.changeFocusLayer(addLayer.id)
  }

  protected copyLayer () : void
  protected copyLayer (to: number) : void
  protected copyLayer (id:number, to: number) : void
  protected copyLayer (value?: number, to?:number) : void {
    let toIndex : number | undefined = to
    let manager : Manager
    if (value) {
      toIndex = to || value
      manager = to ? this.layers[value] : this.focusLayer
    }

    if (toIndex) {
      this.addLayer(manager)
    }
  }

  protected changeFocusLayer (id: number) : void {
    const changeLayer : Layer | undefined = this.layers.find((layer: Layer) => layer.id === id)
    if (changeLayer) {
      this.focusLayer = changeLayer
    }
  }

  protected getCanvas () : HTMLCanvasElement {
    return this.canvas
  }

  protected add (obj : DrawObject) : void
  protected add (obj : DrawObject, option : MainAddOption) : void
  protected add (obj : DrawObject, layerId : number) : void
  protected add (obj : DrawObject, layerId : number, option : MainAddOption) :void
  protected add (obj : DrawObject, value? : MainAddOption | number, option? : MainAddOption) : void {
    let id : number = -1
    let op : MainAddOption
    if (typeof value === 'number') {
      id = value
      op = option || {}
    } else {
      op = value || {}
    }
    if (this.randomColor && !op.color) {
      op.color = this.randomColor[this.random(this.randomColor)]
    }
    if (id === -1) {
      this.focusLayer.manager.add(obj, op)
    } else {
      this.layers[id].manager.add(obj, op)
    }
  }

  protected random (array : Array<any>) : number
  protected random (max : number) : number
  protected random (max : number, min :number) : number
  protected random (val1 : number | Array<any>, min? :number) : number {
    if (Array.isArray(val1)) {
      return Math.floor(Math.random() * val1.length)
    } else {
      return Math.floor(Math.random() * val1) + (min || 0)
    }
  }

  public start () : void {
    const ctx = this.ctx
    if (ctx) {
      ctx.clearRect(0, 0, this.canvas.width, this.canvas.height)
      this.paint(ctx)
      this.layers.forEach((layer : Layer) => {
        if (layer.manager.objectExists()) {
          layer.manager.action(ctx)
        }
      })
    }
  }
}
