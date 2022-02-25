import { describe, expect, it } from "vitest";

import { mount } from "@vue/test-utils";
import CourseCard from "../CourseCard.vue";

describe("CourseCard", () => {
  it("renders properly", () => {
    const wrapper = mount(CourseCard, {
      props: {
        course: {
          title: "Test course",
          topic: "Fullstack",
          level: 2,
          duration: 5,
        },
      },
    });
    expect(wrapper.text()).toContain("Intermediate");
  });
});
