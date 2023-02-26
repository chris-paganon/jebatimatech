jQuery(document).ready(function( $ ) {

  function nestedReactiveProxy(target, key, handler) {
    if (key == 'isProxy') return true;
    const prop = target[key];
    if (typeof prop == 'undefined') return;

    // set value as proxy if object
    if (!prop.isProxy && typeof prop === 'object') {
      target[key] = new Proxy(prop, handler);
    }
    return target[key];
  }

  const solutionsHandler = {
    get(target, key) {
      return nestedReactiveProxy(target, key, solutionsHandler)
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
      return nestedReactiveProxy(target, key, filtersHandler)
    },
    set(object, key, value) {
      if ( ('slug' in object) && key === 'active' && typeof value === 'boolean' ) {
        object[key] = value
        updateSolutions()
        updateFiltersDOM()
        return true
      }
      return Reflect.set(...arguments)
    }
  }

  filters = new Proxy(filters, filtersHandler)
  solutions = new Proxy(solutions, solutionsHandler)
  console.log('filters:', filters)
  console.log('solutions', solutions)

  /**
   * Attach callback to each filter item
   */
  filters.forEach(filter => {
    filter.filter_items.forEach( filter_item => {
      $(`#filter-${filter.slug} #filter-item-${filter_item.slug}`).click( (event) => {
        filter_item.active = event.target.checked
      })
      $('.jbati-active-filters-pills').on('click', `.jbati-pill[data-filter-slug="${filter.slug}"][data-filter-item-slug="${filter_item.slug}"]`, (event) => {
        filter_item.active = false
      })
    })
  })

  $('#jbati-made-in-ca-switch').click( (event) => {
    filters.find( filter => filter.slug == "pays_origine" ).filter_items.find( filter_item => filter_item.slug == "canada" ).active = event.target.checked
  })

  /**
   * Update the 'active' value of solutions from active filters
   */
  function updateSolutions() {
    solutions = solutions.map( solution => {
      solution.active = true
      filters.forEach( filter => {
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
   * Add filter pills and keep the checkboxes in sync with the pills (if pill is used to remove filter)
   */
  function updateFiltersDOM() {
    const active_filters_pills = []
    filters.forEach( filter => {
      return filter.filter_items.map( filter_item => {
        if (filter_item.active === false) {
          $(`#filter-${filter.slug} #filter-item-${filter_item.slug}`).prop('checked', false)
        } else {
          $(`#filter-${filter.slug} #filter-item-${filter_item.slug}`).prop('checked', true)
          active_filters_pills.push(`<span class="jbati-pill" data-filter-slug="${filter.slug}" data-filter-item-slug="${filter_item.slug}">${filter_item.label}</span>`)
        }
      })
    })
    $('.jbati-active-filters-pills').html(active_filters_pills.flat().join(''))
  }

  /**
   * Switch component
   */
  $('.jbati-switch').click( (event) => {
    $(event.currentTarget).toggleClass('active')
  })

  /**
   * Accordion for filters
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
    const solution = solutions.find( solution => solution.id == solution_id )
    window.location = solution.link
  })
})