interface AnchorElemet {
  tag?: string,
  id?: string,
  text?: string,
  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  children: Array<AnchorElemet>
}

export default class AnchorList {
  private dom : string

  constructor (dom : string) {
    this.dom = dom
  }

  parse (node : string) : AnchorElemet {
    let retry : number = 0
    while (retry !== -1) {

    }
  }

  private querySearch () :boolean {
    
  }

  tagNameSelectorAll (selectTags : string) : Array<AnchorElemet> {
    const list : Array<AnchorElemet> = []

    const tags : Array<string> = selectTags.split(',')
    let regex : string = ''
    for (let i = 0; i < tags.length; i++) {
      const or = i !== 0 ? '|' : ''
      regex = regex + or + tags[i]
    }
    const regexp = new RegExp('<(h1|h2).*?(?=.*?id="(.*?)").*?>(.*?)</(h1|h2)>', 'g')
    const elements : Array<RegExpMatchArray> = [...this.dom.matchAll()]

    elements.forEach((elem : RegExpMatchArray) => {
      const obj : AnchorElemet = {
        tag: elem[0],
        id: elem[1],
        text: elem[2],
        children: []
      }
      list.push(obj)
    })

    return list
  }

  private createRegex (tags : Array<string>) : string {
    let regex : string = '/'
    for (let i = 0; i < tags.length; i++) {
      const or = i !== 0 ? '|' : ''
      regex = regex + or + tags[i]
    }
    return regex + '/'
  }
}
