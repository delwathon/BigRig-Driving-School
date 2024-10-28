export function wizard(steps) {
  return {
    currentStep: 0,
    currentProgress: 0,
    maxSteps: steps,
    pinStatus : false,
    submitting:false,
    nextStep() {
      if (this.currentStep < this.maxSteps) {
        this.currentStep = this.currentStep + 1
        this.currentProgress = (this.currentStep / this.maxSteps) * 100
        // console.log('Progress: ', this.currentProgress)
      }
    },
    prevStep() {
      if (this.currentStep > 0) {
        this.currentStep = this.currentStep - 1
        this.currentProgress = (this.currentStep / this.maxSteps) * 100
        // console.log('Progress: ', this.currentProgress)
      }
    },

    pin(c) {
      // console.log(c);
      this.pinStatus = c;
      this.submitting = !c;

    },


    submittingStatus(c) {
      // console.log(c);
      this.submitting = c;
    }
  }
}
