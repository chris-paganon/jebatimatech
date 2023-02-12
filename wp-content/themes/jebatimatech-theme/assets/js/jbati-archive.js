jQuery(document).ready(function( $ ) {
  console.log('filters:', filters)
  console.log('solutions', solutions)

  function nestedProxyGetter(target, key, handler) {
    if (key == 'isProxy')
      return true;

    const prop = target[key];

    // return if property not found
    if (typeof prop == 'undefined')
      return;

    // set value as proxy if object
    if (!prop.isProxy && typeof prop === 'object')
      target[key] = new Proxy(prop, handler);

    return target[key];
  }

  const solutionsHandler = {
    get(target, key) {
      return nestedProxyGetter(target, key, solutionsHandler)
    },
    set(object, key, value) {
      if ( ('id' in object) && key === 'active' && typeof value === 'boolean' ) {
        updateSolutionsDOM(object.id, value)
      }
      return Reflect.set(...arguments)
    }
  }

  const filtersHandler = {
    get(target, key) {
      return nestedProxyGetter(target, key, filtersHandler)
    },
    set(object, key, value) {
      if ( ('slug' in object) && key === 'active' && typeof value === 'boolean' ) {
        // updateSolutions(object.id, value)
      }
      return Reflect.set(...arguments)
    }
  }

  let filtersProxy = new Proxy(filters, filtersHandler)
  let solutionsProxy = new Proxy(solutions, solutionsHandler)

  /**
   * Attach callback to each filter item
   */
  filtersProxy.forEach(filter => {
    filter.filter_items.forEach( filter_item => {
      $(`#filter-${filter.slug} #filter-item-${filter_item.slug}`).click( (event) => {
        filter_item.active = event.target.checked
        filterItemClicked()
      })
    })
  })

  /**
   * Update the 'active' value of solutions from active filters
   */
  function filterItemClicked() {
    solutionsProxy = solutionsProxy.map( solution => {
      solution.active = true
      filtersProxy.forEach( filter => {
        filter.filter_items.forEach( filter_item => {
          const matching_property = solution.properties.find( property => property.slug == filter.slug )
          if ( filter_item.active === true && matching_property && ! matching_property.values.some(value => value.slug == filter_item.slug) ) {
            solution.active = false
          }
        })
      })
      return solution
    })
  }
  
  /**
   * Update the DOM to show or hide solutions
   */
  function updateSolutionsDOM(solution_id, active) {
    if (active) {
      $(`.jbati-solution[data-solution-id="${solution_id}"]`).addClass('active')
    } else {
      $(`.jbati-solution[data-solution-id="${solution_id}"]`).removeClass('active')
    }
  }

  /**
   * Accordeon for filters
   */
  $('.jbati-accordion-button').click( (event) => {
    $(event.target).parents('.jbati-accordion-item').toggleClass('active')
  })

  /**
   * Solution link
   */
  $('.jbati-solution').click( (event) => {
    if ( $(event.target).is('a') ) return
    const solution_id = $(event.currentTarget).attr('data-solution-id')
    const solution = solutionsProxy.find( solution => solution.id == solution_id )
    window.location = solution.link
  })
})