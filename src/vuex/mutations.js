const mutations = {
  showLeftMenu(state, status) {
    state.showLeftMenu = status
  },
  showLoading(state, status) {
    state.globalLoading = status
  },
  setMenus(state, menus) {
    state.menus = menus
  },
  setRules(state, rules) {
    state.rules = rules
  },
  setUsers(state, users) {
    state.users = users
  },
  setUserGroups(state, userGroups) {
    state.userGroups = userGroups
  },
  setOrganizes(state, organizes) {
    state.organizes = organizes
  },
  setGroups(state, Groups) {
    state.Groups = Groups
  },
  setStudios(state, Studios) {
    state.Studios = Studios
  },
  setTaches(state, Taches) {
    state.Taches = Taches
  },
  setOrganizes(state, organizes) {
    state.organizes = organizes
  }
}

export default mutations
